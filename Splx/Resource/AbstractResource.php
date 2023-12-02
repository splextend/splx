<?php

namespace Splx\Resource;

use Splx\Core\Proto;
use Splx\Core\Misc;
use Splx\Core\Reflection;
use Splx\Core\Assert;
use BadMethodCallException;

/**
 * Class AbstractResource
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 */
abstract class AbstractResource extends Proto
{
    protected $resource;
    protected static $prefix;
    protected static $functions = [];
    protected static $staticFunctions = [];
    protected static $watchFalseFunctions = [];

    protected static $selfReturnMethods = [];


    public static function createFromResource($resource)
    {

    }

    /**
     * @param $resource
     * @param $validate
     * @return void
     */
    protected function setResource($resource, $validate = 'resource')
    {
        Assert::validateInstance(
            $resource,
            $validate,
            'Splx\Resource\ResourceException'
        );

        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    protected function getResource()
    {
        return $this->resource;
    }

    /**
     * @param $method
     * @param array $arguments
     * @param $thisis
     * @return mixed
     */
    private static function resolveFunctionCall($method, array $arguments = [], $thisis = null)
    {
        $function = self::methodToFunction($method);
        $arguments = array_map('self::safeValue', $arguments);

        if (function_exists('error_clear_last')) {
            error_clear_last();
        }

        $value = call_user_func_array($function, $arguments);

        if (false === $value) {
            Assert::throwLastErrorIfFalse(
                in_array($function, static::$watchFalseFunctions)
            );
        }

        if ($thisis and in_array($function, static::$selfReturnMethods)) {
            return $thisis;
        }

        return $value;
    }

    /**
     * @param $method
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($method, array $arguments)
    {
        return self::resolveFunctionCall($method, $arguments);
    }

    /**
     * @param $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, array $arguments)
    {
        array_unshift($arguments, $this->resource);

        return self::resolveFunctionCall($method, $arguments, $this);
    }

    /**
     * @param $function
     * @return array|string|string[]|null
     */
    private static function functionToMethod($function)
    {
        if (0 === strpos($function, static::$prefix)) {
            $function = substr($function, strlen(static::$prefix));
        }

        return Misc::toCamelCase($function);
    }


    /**
     * @param $method
     * @param $caller
     * @return mixed
     */
    protected static function methodToFunction($method, $caller = null)
    {
        if (!$caller) {
            $caller = get_called_class();
        }

        $function = Misc::toSnakeCase($method);

        foreach ([$function, static::$prefix . $function] as $call) {
            if (in_array($call, static::$functions, true)) {
                return $call;
            }

            if (in_array($call, static::$staticFunctions, true)) {
                return $call;
            }
        }

        $parentClass = get_parent_class(get_called_class());
        if (is_subclass_of($parentClass, __CLASS__) or $parentClass === __CLASS__) {
            return call_user_func([$parentClass, 'methodToFunction'], $method, $caller);
        }

        throw new BadMethodCallException(sprintf(
            "Method '%s' is not defined in '%s'",
            $method,
            $caller
        ));
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function exportCallPrototype()
    {
        $methodsMap = [
            ''       => self::$functions,
            'static' => self::$staticFunctions
        ];

        $doc = '/**' . PHP_EOL;
        foreach ($methodsMap as $prefix => $functions) {
            foreach ($functions as $function) {
                $doc .= ' * ' . Reflection::extractPrototypeDocFor(
                    $function,
                    $this->functionToMethod($function),
                    !!$prefix
                ) . PHP_EOL;
            }
        }

        $doc .= ' */' . PHP_EOL;

        return $doc;
    }

    /**
     * @return mixed
     */
    public function valueOf()
    {
        return $this->getResource();
    }
}

<?php

namespace Splx\Core;

use Exception;
use ReflectionParameter;
use ReflectionUnionType;
use ReflectionNamedType;
use ReflectionFunction;
use ReflectionException;
use ReflectionFunctionAbstract;

/**
 * Class Reflection
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Reflection
{
    /**
     * @param ReflectionParameter $reflectionParameter
     * @return false|string
     */
    public static function resolveArgumentHintType(ReflectionParameter $reflectionParameter)
    {
        $hintType = false;

        $lastVersionFeatures = (
                method_exists($reflectionParameter, 'hasType')
            and $reflectionParameter->hasType()
        );

        if ($lastVersionFeatures and $type = $reflectionParameter->getType()) {
            if ($type instanceof ReflectionUnionType) {
                $hintType = implode('|', $type->getTypes());
            } elseif ($type instanceof ReflectionNamedType) {
                $hintType = $type->getName();
            } else {
                $hintType = $type;
            }
        } elseif (method_exists($reflectionParameter, 'getClass') and $class = $reflectionParameter->getClass()) {
            $hintType = $class->getName();
        } elseif ($reflectionParameter->isArray()) {
            $hintType = 'array ';
        } elseif ($reflectionParameter->isCallable()) {
            $hintType = 'callable ';
        }

        return $hintType;
    }

    /**
     * @param ReflectionFunctionAbstract $reflectionFunction
     * @param $isStatic
     * @return array
     * @throws ReflectionException
     */
    public static function extractArgumentPrototype(ReflectionFunctionAbstract $reflectionFunction, $isStatic = true)
    {
        $reflectionParameters = $reflectionFunction->getParameters();

        $export = array();
        foreach ($reflectionParameters as $reflectionParameter) {
            if (false === $isStatic and 0 === $reflectionParameter->getPosition()) {
                continue;
            }

            $inline = array();
            if ($hintType = self::resolveArgumentHintType($reflectionParameter)) {
                $inline[] = $hintType;
            }

            $inline[] = Misc::toCamelCase(
                ($reflectionParameter->isPassedByReference() ? '&' : '') .
                '$' .
                $reflectionParameter->getName()
            );

            if ($reflectionParameter->isDefaultValueAvailable()) {
                $inline[] = '=';
                if ($reflectionParameter->isDefaultValueConstant()) {
                    $inline[] = $reflectionParameter->getDefaultValueConstantName();
                } else {
                    $inline[] = $reflectionParameter->getDefaultValue();
                }
            }

            $export[] = implode(' ', $inline);
        }

        return $export;
    }

    /**
     * @param $function
     * @param $name
     * @param $isStatic
     * @return string
     */
    public static function extractPrototypeDocFor($function, $name, $isStatic = false)
    {
        try {
            $reflectionFunction = new ReflectionFunction($function);
            $export = self::extractArgumentPrototype($reflectionFunction, $isStatic);
        } catch (Exception $e) {
            $export = [];
        }

        return (
            '@method ' .
            ($isStatic ? 'static ' : '') .
            $name .
            '(' . implode(', ', $export) . ')'
        );
    }
}

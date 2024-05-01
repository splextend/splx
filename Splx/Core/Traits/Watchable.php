<?php

namespace Splx\Core\Traits;

/**
 * Trait ArrayIterator
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
trait Watchable
{
    protected $watchers = [];

    /**
     * @param callable $callback
     * @param $key
     * @return $this
     */
    public function watch(callable $callback, $key = null)
    {
        if (null === $key) {
            $key = '*';
        }

        if (!isset($this->watchers[$key])) {
            $this->watchers[$key] = [];
        }

        $this->watchers[$key][] = $callback;

        return $this;
    }

    /**
     * @param $watcher
     * @param $key
     * @return bool
     */
    public function unwatch($watcher, $key = null)
    {
        if (null === $key) {
            $key = '*';
        }

        if (!isset($this->watchers[$key])) {
            return false;
        }

        foreach ($this->watchers[$key] as $index => $callback) {
            if ($callback === $watcher) {
                unset($this->watchers[$index]);

                return true;
            }
        }

        return false;
    }

    /**
     * @param $action
     * @param $key
     * @param $value
     * @param $oldValue
     * @return void
     */
    public function resolveWatch($action, $key, $value, $oldValue = null)
    {
        if ($this->watchers) {
            foreach (['*', $key] as $eventKey => $callbackStack) {
                if (isset($this->watchers[$eventKey])) {
                    foreach ($this->watchers[$eventKey] as $callback) {
                        call_user_func(
                            $callback,
                            $this,
                            $action,
                            $key,
                            $value,
                            $oldValue
                        );
                    }
                }
            }
        }
    }
}

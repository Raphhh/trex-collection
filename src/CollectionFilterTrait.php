<?php
namespace TRex\Collection;

trait CollectionFilterTrait
{
    /**
     * @param callable|null $filter
     * @param int $flag (only for php version >= 5.6)
     * @return $this
     */
    public function filter(callable $filter = null, $flag = 0)
    {
        if (defined('HHVM_VERSION')) {
            if (version_compare(HHVM_VERSION, '3.8.1', '>=')) {
                return new $this(array_filter((array)$this, $filter, $flag));
            }
        } else {
            if (version_compare(phpversion(), '5.6.0', '>=')) {
                return new $this(array_filter((array)$this, $filter, $flag));
            }
        }
        return new $this(array_filter((array)$this, $filter));
    }

    /**
     * Executes the callback for every value.
     * Returns a collection with the result of each callback call.
     * If the callback returns nothing, the returned collection will contain same values as the original ones.
     *
     * @param callable $callback
     * @param array $args
     * @return $this
     */
    public function each(callable $callback, array $args = [])
    {
        return new $this(array_map(
            function ($value) use ($callback, $args) {
                return call_user_func($callback, $value, $args) ?: $value;
            },
            (array)$this
        ));
    }

    /**
     * Executes the callback for every value.
     * Returns false if the callback returns once a falsy value.
     *
     * @param callable $callback
     * @return bool
     */
    public function assert(callable $callback)
    {
        foreach ($this as $key => $value) {
            if (!call_user_func($callback, $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Extracts the sequence of elements.
     * Starts at index $startIndex and stop after $length keys.
     *
     * @param int $startIndex
     * @param int $length
     * @param bool $areKeysPreserved
     * @return mixed
     */
    public function extract($startIndex, $length = 0, $areKeysPreserved = true)
    {
        $collection = (array)$this;
        $length = $length ?: count($collection);
        return new $this(array_slice($collection, $startIndex, $length, $areKeysPreserved));
    }

    /**
     * @param int $length
     * @return $this
     */
    public function rand($length = 1)
    {
        $keys = (array)array_rand((array)$this, $length);
        $result = new $this;
        foreach ($this as $key => $value) {
            if (in_array($key, $keys)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
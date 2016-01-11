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
        if (version_compare(phpversion(), '5.6.0', '>=')) {
            return new $this(array_filter((array)$this, $filter, $flag));
        }
        return new $this(array_filter((array)$this, $filter));
    }

    /**
     * Executes the callback for every value.
     * Returns a collection with the result of each callback call.
     *
     * @param callable $callback
     * @param array $args
     * @return $this
     */
    public function each(callable $callback, array $args = [])
    {
        return new $this(array_map(
            function($value) use($callback, $args){
                return call_user_func($callback, $value, $args) ?: $value;
            },
            (array)$this
        ));
    }
}
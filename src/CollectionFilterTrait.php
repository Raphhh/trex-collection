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
}
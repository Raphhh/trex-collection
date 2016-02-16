<?php
namespace TRex\Collection;

trait CollectionSorterTrait
{
    /**
     * @return $this
     */
    public function reindex()
    {
        return new $this(array_values((array)$this));
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function sort(callable $callback)
    {
        $collection = (array)$this;
        uasort($collection, $callback);
        return new $this($collection);
    }
}

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

    /**
     * @param bool $areKeysPreserved
     * @return $this
     */
    public function reverse($areKeysPreserved = true)
    {
        return new $this(array_reverse((array)$this, $areKeysPreserved));
    }

    /**
     * @param bool $areKeysPreserved
     * @return $this
     */
    public function shuffle($areKeysPreserved = true)
    {
        if($areKeysPreserved){
            return $this->sort(function(){
                return mt_rand(-1, 1);
            });
        }

        $collection = (array)$this;
        shuffle($collection);
        return new $this($collection);
    }

    /**
     * @param callable $callback
     * @return $this[]
     */
    public function groupBy(callable $callback)
    {
        $results = [];
        $collection = new Collection($this);
        foreach ($collection->each($callback) as $key => $result) {
            if (!isset($results[$result])) {
                $results[$result] = new $this();
            }
            $results[$result][$key] = $this[$key];
        }
        return $results;
    }
}

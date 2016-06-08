<?php
namespace TRex\Collection;

trait CollectionSorterTrait
{
    /**
     * Reindex the keys
     *
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
     * Reverses the values
     *
     * @param bool $areKeysPreserved
     * @return $this
     */
    public function reverse($areKeysPreserved = true)
    {
        return new $this(array_reverse((array)$this, $areKeysPreserved));
    }

    /**
     * Shuffles the values
     *
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
     * Splits the values into every possible response returned by the callback.
     *
     * For example, if the callback juste return the value:
     * ['a', 'b', 'c']
     * will become:
     * ['a' => ['a'], 'b' => ['b'], 'c' => ['c']]
     *
     * If the callback return a boolean, it will be return an array with two collections.
     * [0 => $nonMatchedCollection, 1 => $matchedCollection]
     * This seems to be quite the same as Doctrine's ARrayCollection. But be careful because keys are inverted.
     *
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

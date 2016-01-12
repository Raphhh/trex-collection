<?php
namespace TRex\Collection;

trait CollectionComparatorTrait
{
    /**
     * merge
     * reindexing of the keys
     *
     * @param mixed $collection
     * @return self
     */
    public function merge($collection /*, ...*/)
    {
        return $this->apply('array_merge', $this->prepareCollections(func_get_args()));
    }

    /**
     * merge without reindexing and override value with a priority by the left
     *
     * @param mixed $collection
     * @return self
     */
    public function mergeA($collection /*, ...*/)
    {
        return $this->apply('array_replace', $this->prepareCollections(func_get_args()));
    }

    /**
     * compare the values
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diff($collection /*, ...*/)
    {
        return $this->apply('array_diff', $this->prepareCollections(func_get_args()));
    }

    /**
     * compare the key/value pairs
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diffA($collection /*, ...*/)
    {
        return $this->apply('array_diff_assoc', $this->prepareCollections(func_get_args()));
    }

    /**
     * compare only the keys
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diffK($collection /*, ...*/)
    {
        return $this->apply('array_diff_key', $this->prepareCollections(func_get_args()));
    }

    /**
     * 
     *
     * @param mixed $collection
     * @return self
     */
    public function intersect($collection /*, ...*/)
    {
        return $this->apply('array_intersect', $this->prepareCollections(func_get_args()));
    }

    /**
     * 
     *
     * @param mixed $collection
     * @return self
     */
    public function intersectA($collection /*, ...*/)
    {
        return $this->apply('array_intersect_assoc', $this->prepareCollections(func_get_args()));
    }

    /**
     * 
     *
     * @param mixed $collection
     * @return self
     */
    public function intersectK($collection /*, ...*/)
    {
        return $this->apply('array_intersect_key', $this->prepareCollections(func_get_args()));
    }

    /**
     * Calls a php native function with $collectionList as args.
     * Returns a new instance of Collection as result.
     *
     * @param string $functionName
     * @param array $collectionList
     * @return self
     */
    private function apply($functionName, array $collectionList)
    {
        return new $this(call_user_func_array($functionName, $this->parseCollectionsListToArray($collectionList)));
    }

    /**
     * Transforms a list of mixed in an simple array.
     *
     * @param array $collectionList
     * @return array
     */
    private function parseCollectionsListToArray(array $collectionList)
    {
        return array_map(
            function ($collection) {
                return (array)$collection;
            },
            $collectionList
        );
    }

    /**
     * Unshifts $this to $array.
     *
     * @param array $array
     * @return array
     */
    private function prepareCollections(array $array)
    {
        array_unshift($array, $this);
        return $array;
    }
}

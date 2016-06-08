<?php
namespace TRex\Collection;

interface CollectionComparatorInterface
{
    /**
     * merge
     * reindexing of the keys
     *
     * @param mixed $collection
     * @return self
     */
    public function merge($collection /*, ...*/);

    /**
     * merge without reindexing and override value with a priority by the left
     *
     * @param mixed $collection
     * @return self
     */
    public function mergeA($collection /*, ...*/);

    /**
     * compare the values
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diff($collection /*, ...*/);

    /**
     * compare the key/value pairs
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diffA($collection /*, ...*/);

    /**
     * compare only the keys
     * no reindexing
     *
     * @param mixed $collection
     * @return self
     */
    public function diffK($collection /*, ...*/);

    /**
     *
     *
     * @param mixed $collection
     * @return self
     */
    public function intersect($collection /*, ...*/);
    /**
     *
     *
     * @param mixed $collection
     * @return self
     */
    public function intersectA($collection /*, ...*/);
    /**
     *
     *
     * @param mixed $collection
     * @return self
     */
    public function intersectK($collection /*, ...*/);
}
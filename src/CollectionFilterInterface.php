<?php
namespace TRex\Collection;

interface CollectionFilterInterface
{
    /**
     * @param callable|null $filter
     * @param int $flag (only for php version >= 5.6)
     * @return $this
     */
    public function filter(callable $filter = null, $flag = 0);

    /**
     * Executes the callback for every value.
     * Returns a collection with the result of each callback call.
     * If the callback returns nothing, the returned collection will contain same values as the original ones.
     *
     * @param callable $callback
     * @param array $args
     * @return $this
     */
    public function each(callable $callback, array $args = []);

    /**
     * Executes the callback for every value.
     * Returns false if the callback returns once a falsy value.
     *
     * @param callable $callback
     * @return bool
     */
    public function assert(callable $callback);

    /**
     * Extracts the sequence of elements.
     * Starts at index $startIndex and stop after $length keys.
     *
     * @param int $startIndex
     * @param int $length
     * @param bool $areKeysPreserved
     * @return mixed
     */
    public function extract($startIndex, $length = 0, $areKeysPreserved = true);

    /**
     * @param int $length
     * @return $this
     */
    public function rand($length = 1);
}
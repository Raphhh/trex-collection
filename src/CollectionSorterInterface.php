<?php
namespace TRex\Collection;

interface CollectionSorterInterface
{
    /**
     * Reindex the keys
     *
     * @return $this
     */
    public function reindex();

    /**
     * Reverses the values
     *
     * @param bool $areKeysPreserved
     * @return $this
     */
    public function reverse($areKeysPreserved = true);

    /**
     * Shuffles the values
     *
     * @param bool $areKeysPreserved
     * @return $this
     */
    public function shuffle($areKeysPreserved = true);

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
    public function groupBy(callable $callback);
}
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
}

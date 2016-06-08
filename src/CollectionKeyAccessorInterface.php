<?php
namespace TRex\Collection;

interface CollectionKeyAccessorInterface
{
    /**
     * @param mixed $value
     * @param bool $isStrict
     * @return array
     */
    public function search($value, $isStrict = true);

    /**
     * @return array
     */
    public function keys();
}
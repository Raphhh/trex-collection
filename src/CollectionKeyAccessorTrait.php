<?php
namespace TRex\Collection;

trait CollectionKeyAccessorTrait
{

    /**
     * @param mixed $value
     * @param bool $isStrict
     * @return array
     */
    public function search($value, $isStrict = true)
    {
        return array_keys((array)$this, $value, $isStrict);
    }

    /**
     * @return array
     */
    public function keys()
    {
        return array_keys((array)$this);
    }
}
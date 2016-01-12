<?php
namespace TRex\Collection;

trait CollectionValueAccessorTrait
{
    /**
     * @param mixed $value
     * @param bool $isStrict
     * @return bool
     */
    public function has($value, $isStrict = true)
    {
        return in_array($value, (array)$this, $isStrict);
    }

    /**
     * @return mixed|null
     */
    public function first()
    {
        $array = (array)$this;
        return array_shift($array);
    }

    /**
     * @return mixed|null
     */
    public function last()
    {
        $array = (array)$this;
        return array_pop($array);
    }
}
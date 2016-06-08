<?php
namespace TRex\Collection;

interface CollectionValueAccessorInterface
{
    /**
     * @param mixed $value
     * @param bool $isStrict
     * @return bool
     */
    public function has($value, $isStrict = true);

    /**
     * @return mixed|null
     */
    public function first();

    /**
     * @return mixed|null
     */
    public function last();
}
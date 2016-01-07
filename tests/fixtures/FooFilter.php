<?php
namespace TRex\Collection\fixtures;

use TRex\Collection\AbstractFilter;

class FooFilter extends AbstractFilter
{
    /**
     * @param mixed $object
     * @return mixed
     */
    protected function invoke($object)
    {
        return $object->foo;
    }
}

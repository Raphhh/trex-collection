<?php
namespace TRex\Collection\fixtures;

use TRex\Collection\AbstractSorter;

class FooSorter extends AbstractSorter
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

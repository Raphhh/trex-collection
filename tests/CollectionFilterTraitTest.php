<?php
namespace TRex\Collection;

use TRex\Collection\fixtures\Bar;
use TRex\Collection\fixtures\FooFilter;

class CollectionFilterTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testFilter()
    {
        $collection = new Collection([
            new Bar('a'),
            new Bar('a'),
            new Bar('b'),
            new Bar('b'),
        ]);

        $result = $collection->filter(new FooFilter('a'));
        $this->assertNotSame($collection, $result);
        $this->assertInstanceOf(get_class($collection), $collection);
        $this->assertCount(2, $result);
    }
}

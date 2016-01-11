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

    public function testEachWithoutreturn()
    {
        $collection = new Collection([
            new Bar('a'),
        ]);

        $result = $collection->each(function($bar){
            $bar->foo = strtoupper($bar->foo);
        });

        $this->assertNotSame($collection, $result);
        $this->assertInstanceOf(get_class($collection), $result);
        $this->assertCount(1, $result);

        foreach($result as $bar){
            $this->assertSame('A', $bar->foo);
        }
    }

    public function testEachWithReturn()
    {
        $collection = new Collection([
            'a'
        ]);

        $result = $collection->each(function($bar){
            return strtoupper($bar);
        });

        $this->assertNotSame($collection, $result);
        $this->assertInstanceOf(get_class($collection), $result);
        $this->assertCount(1, $result);

        foreach($result as $bar){
            $this->assertSame('A', $bar);
        }
    }
}

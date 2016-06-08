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
        $this->assertInstanceOf(get_class($collection), $result);
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

    public function testExtractDefault()
    {
        $data = array(
            1 => 'a',
            0 => 'b',
            'a' => 1,
            'b' => 0,
        );
        $collection = new Collection($data);
        $result = $collection->extract(1);
        $this->assertNotSame($collection, $result);
        $this->assertInstanceOf(get_class($collection), $result);
        $this->assertSame(array_slice($data, 1, 3, true), (array)$result);
    }

    public function testExtractWithLength()
    {
        $data = array(
            1 => 'a',
            0 => 'b',
            'a' => 1,
            'b' => 0,
        );
        $collection = new Collection($data);
        $result = $collection->extract(1, 2);
        $this->assertInstanceOf(get_class($collection), $result);
        $this->assertSame(array_slice($data, 1, 2, true), (array)$result);
    }

    public function testExtractWithoutPreservedKeys()
    {
        $data = array(
            1 => 'a',
            0 => 'b',
            'a' => 1,
            'b' => 0,
        );
        $collection = new Collection($data);
        $result = $collection->extract(1, 0, false);
        $this->assertInstanceOf(get_class($collection), $result);
        $this->assertSame(array_slice($data, 1, 3, false), (array)$result);
    }

    public function testAssertFalse()
    {
        $i = 0;
        $data = [false, true];
        $collection = new Collection($data);
        $result = $collection->assert(function ($value) use (&$i) {
            ++$i;
            return $value;
        });
        $this->assertFalse($result);
        $this->assertSame(1, $i);
    }

    public function testAssertTrue()
    {
        $i = 0;
        $data = [true, true];
        $collection = new Collection($data);
        $result = $collection->assert(function ($value) use (&$i) {
            ++$i;
            return $value;
        });
        $this->assertTrue($result);
        $this->assertSame(2, $i);
    }
}

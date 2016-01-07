<?php
namespace TRex\Collection;

use TRex\Collection\fixtures\Bar;
use TRex\Collection\fixtures\FooFilter;

class AbstractFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testInvokeByDefault()
    {
        $collection = [
            new Bar('a'),
            new Bar('c'),
            new Bar('c'),
            new Bar('b'),
        ];


        $result = array_filter($collection, new FooFilter('c'));
        $this->assertCount(2, $result);
        foreach($result as $bar){
            $this->assertSame('c', $bar->foo);
        }
    }

    public function testInvokeWithOneOfTheValues()
    {
        $collection = [
            new Bar('a'),
            new Bar('c'),
            new Bar('c'),
            new Bar('b'),
        ];


        $result = array_filter($collection, new FooFilter(['a', 'b'], true));
        $this->assertCount(2, $result);
        $this->assertSame('a', $result[0]->foo);
        $this->assertSame('b', $result[3]->foo);
    }

    public function testInvokeStrict()
    {
        $collection = [
            new Bar('1'),
            new Bar(1),
            new Bar(2),
        ];


        $result = array_filter($collection, new FooFilter(1));
        $this->assertCount(1, $result);
        $this->assertSame(1, $result[1]->foo);
    }

    public function testInvokeNotStrict()
    {
        $collection = [
            new Bar('1'),
            new Bar(1),
            new Bar(2),
        ];


        $result = array_filter($collection, new FooFilter(1, false, false));
        $this->assertCount(2, $result);
        $this->assertSame('1', $result[0]->foo);
        $this->assertSame(1, $result[1]->foo);
    }
}

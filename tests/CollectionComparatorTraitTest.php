<?php
namespace TRex\Collection;

class CollectionComparatorTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testMerge()
    {
        $collection1 = new Collection(['a', 'b']);
        $collection2 = new Collection(['a', 'c']);
        $collection3 = new Collection(['d', 'e']);

        $result = $collection1->merge($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame(['a', 'b', 'a', 'c', 'd', 'e'], (array)$result);
    }

    public function testMergeA()
    {
        $collection1 = new Collection(['a' => 'a', 'b' => 'b']);
        $collection2 = new Collection(['a' => 'a', 'c' => 'c']);
        $collection3 = new Collection(['a' => 'a', 'e' => 'e']);

        $result = $collection1->mergeA($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame(['a' => 'a', 'b' => 'b', 'c' => 'c', 'e' => 'e'], (array)$result);
    }


    public function testDiff()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'c']);
        $collection3 = new Collection(['d', 'e']);

        $result = $collection1->diff($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([1 => 'b'], (array)$result);
    }

    public function testDiffA()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'c']);
        $collection3 = new Collection(['d', 'e']);

        $result = $collection1->diffA($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([1 => 'b', 2 => 'e'], (array)$result);
    }

    public function testDiffK()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'c']);
        $collection3 = new Collection(['d', 'e']);

        $result = $collection1->diffK($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([2 => 'e'], (array)$result);
    }

    public function testIntersect()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'e', 'c']);
        $collection3 = new Collection(['a', 'c', 'e']);

        $result = $collection1->intersect($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([0 => 'a', 2 => 'e'], (array)$result);
    }

    public function testIntersectA()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'e', 'c']);
        $collection3 = new Collection(['a', 'c', 'e']);

        $result = $collection1->intersectA($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([0 => 'a'], (array)$result);
    }

    public function testIntersectK()
    {
        $collection1 = new Collection(['a', 'b', 'e']);
        $collection2 = new Collection(['a', 'e']);
        $collection3 = new Collection(['a', 'c', 'e']);

        $result = $collection1->intersectK($collection2, $collection3);
        $this->assertNotSame($collection1, $result);
        $this->assertInstanceOf(get_class($collection1), $result);
        $this->assertSame([0 => 'a', 1 => 'b'], (array)$result);
    }
}

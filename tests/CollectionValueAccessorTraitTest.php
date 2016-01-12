<?php
namespace TRex\Collection;

class CollectionValueAccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testHasStrict()
    {
        $collection = new Collection(['1']);
        $this->assertTrue($collection->has('1'));
        $this->assertFalse($collection->has(1));
    }

    public function testHasNotStrict()
    {
        $collection = new Collection(['1']);
        $this->assertTrue($collection->has('1', false));
        $this->assertTrue($collection->has(1, false));
        $this->assertFalse($collection->has(2, false));
    }

    public function testFirst()
    {
        $collection = new Collection(['a' => 'c', 'b' => 'd']);
        $this->assertSame('c', $collection->first());
    }

    public function testLast()
    {
        $collection = new Collection(['a' => 'c', 'b' => 'd']);
        $this->assertSame('d', $collection->last());
    }
}

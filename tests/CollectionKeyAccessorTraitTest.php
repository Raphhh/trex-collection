<?php
namespace TRex\Collection;

class CollectionKeyAccessorTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSearchStrict()
    {
        $collection = new Collection(['1', '2']);
        $this->assertSame([0], $collection->search('1'));
        $this->assertSame([], $collection->search(1));
    }

    public function testSearchNotStrict()
    {
        $collection = new Collection(['1', '2']);
        $this->assertSame([0], $collection->search('1', false));
        $this->assertSame([0], $collection->search(1, false));
        $this->assertSame([], $collection->search(3, false));
    }

    public function testKeys()
    {
        $collection = new Collection(['1', 'b' => '2']);
        $this->assertSame([0, 'b'], $collection->keys());
    }
}

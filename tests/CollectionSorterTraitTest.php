<?php
namespace TRex\Collection;

class CollectionSorterTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testReindex()
    {
        $collection = new Collection(['1', 'b' => '2']);
        $this->assertSame([0, 1], $collection->reindex()->keys());
    }
}

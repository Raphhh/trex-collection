<?php
namespace TRex\Collection;

use TRex\Collection\fixtures\Bar;
use TRex\Collection\fixtures\FooSorter;

class AbstractSorterTest extends \PHPUnit_Framework_TestCase
{

    public function testInvokeByDefault()
    {
        $collection = [
            'first' => new Bar('a'),
            'third' => new Bar('c'),
            'fourth' => new Bar('c'),
            'second' => new Bar('b'),
        ];

        $this->assertOrder($collection, ['first', 'third', 'fourth', 'second']);
        uasort($collection, new FooSorter());
        $this->assertOrder($collection, ['first', 'second', 'third', 'fourth']);

    }

    /**
     * @param array $collection
     * @param array $keys
     */
    private function assertOrder(array $collection, array $keys)
    {
        $i = 0;
        foreach ($collection as $key => $object) {
            $this->assertSame($keys[$i], $key, "key #$i should be '$keys[$i]' instead of '$key'");
            ++$i;
        }
    }
}

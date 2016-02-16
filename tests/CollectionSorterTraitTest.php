<?php
namespace TRex\Collection;

use TRex\Collection\fixtures\Bar;
use TRex\Collection\fixtures\FooSorter;

class CollectionSorterTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testReindex()
    {
        $collection = new Collection(['1', 'b' => '2']);
        $this->assertSame([0, 1], $collection->reindex()->keys());
    }

    public function testSort()
    {
        $collection = new Collection([
            'first' => new Bar('a'),
            'third' => new Bar('c'),
            'fourth' => new Bar('c'),
            'second' => new Bar('b'),
        ]);

        $this->assertOrder($collection, ['first', 'third', 'fourth', 'second']);
        $collection = $collection->sort(new FooSorter());
        $this->assertOrder($collection, ['first', 'second', 'third', 'fourth']);
    }

    /**
     * @param Collection $collection
     * @param array $keys
     */
    private function assertOrder(Collection $collection, array $keys)
    {
        $i = 0;
        foreach ($collection as $key => $object) {
            $this->assertSame($keys[$i], $key, "key #$i should be '$keys[$i]' instead of '$key'");
            ++$i;
        }
    }

    public function testGroupBy()
    {
        $collection = new Collection([
            'first' => new Bar('a'),
            'third' => new Bar('c'),
            'fourth' => new Bar('c'),
            'second' => new Bar('b'),
        ]);

        $collections = $collection->groupBy(function(Bar $bar){
            return $bar->foo;
        });

        $this->assertCount(3, $collections);
        $this->assertSame($collection['first'], $collections['a']['first']);
        $this->assertSame($collection['second'], $collections['b']['second']);
        $this->assertSame($collection['third'], $collections['c']['third']);
        $this->assertSame($collection['fourth'], $collections['c']['fourth']);
    }
}

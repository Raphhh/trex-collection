<?php
namespace TRex\Collection;

class Collection extends \ArrayObject implements CollectionInterface
{
    use CollectionValueAccessorTrait;
    use CollectionKeyAccessorTrait;
    use CollectionFilterTrait;
    use CollectionComparatorTrait;
    use CollectionSorterTrait;
}

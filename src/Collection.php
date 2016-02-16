<?php
namespace TRex\Collection;

class Collection extends \ArrayObject
{
    use CollectionValueAccessorTrait;
    use CollectionKeyAccessorTrait;
    use CollectionFilterTrait;
    use CollectionComparatorTrait;
    use CollectionSorterTrait;
}

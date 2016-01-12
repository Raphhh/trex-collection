<?php
namespace TRex\Collection;

class Collection extends \ArrayObject
{
    use CollectionValueAccessorTrait;
    use CollectionFilterTrait;
    use CollectionComparatorTrait;
}

<?php
namespace TRex\Collection;

class Collection extends \ArrayObject
{
    use CollectionFilterTrait;
    use CollectionComparatorTrait;
}

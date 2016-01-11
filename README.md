# TRex Collection

[![Latest Stable Version](https://poser.pugx.org/raphhh/trex-collection/v/stable.svg)](https://packagist.org/packages/raphhh/trex-collection)
[![Build Status](https://travis-ci.org/Raphhh/trex-collection.png)](https://travis-ci.org/Raphhh/trex-collection)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Raphhh/trex-collection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/trex-collection/)
[![Code Coverage](https://scrutinizer-ci.com/g/Raphhh/trex-collection/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/trex-collection/)
[![Total Downloads](https://poser.pugx.org/raphhh/trex-collection/downloads.svg)](https://packagist.org/packages/raphhh/trex-collection)
[![Reference Status](https://www.versioneye.com/php/raphhh:trex-collection/reference_badge.svg?style=flat)](https://www.versioneye.com/php/raphhh:trex-collection/references)
[![License](https://poser.pugx.org/raphhh/trex-collection/license.svg)](https://packagist.org/packages/raphhh/trex-collection)


## Install

`$ composer require raphhh/trex-collection`

## Usages

### Collection

Collection is just an `ArrayObject` implementing some additional methods.

Because Collection is just a facade, you can keep coding with ArrayObject and implements some TRex traits by yourself.

#### CollectionFilterTrait

Provide methods to filter a collection.

##### filter
```php
use TRex\Collection\Collection;

class Bar
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}

$collection = new Collection([
    new Bar('a'),
    new Bar('c'),
    new Bar('b'),
]);

$collection->filter(new FooFilter('bar'));
```

##### each
```php
use TRex\Collection\Collection;

class Bar
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}

$collection = new Collection([
    new Bar('a'),
    new Bar('b'),
]);

$result = $collection->each(function($bar){
    $bar->foo = strtoupper($bar->foo);
});
```


### Sorter

Sort a collection by a property or a method result.

You need to extends the class `TRex\Collection\AbstractSorter`.
In the method `invoke`, you have to return the value to sort for each object the collection content.

Note that the TRex sorter implements duck typing.
You should create a sorter by key to access to the data, and not by type of collection content.
For example, if you want to sort a collection of objects by them property '$foo',
you should call your sorter 'FooSorter', anyway the objects the collection content.


```php
use TRex\Collection\AbstractSorter;

class Bar
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}

// we name the sorter with the name of the property $foo, and not the name of the class Bar
class FooSorter extends AbstractSorter
{
    /**
     * calls the property/method/key to extract the value to sort.
     *
     * @param mixed $object
     * @return mixed
     */
    protected function invoke($object)
    {
        //here, we want to sort the collection by the property $foo
        return $object->foo;
    }
}

$collection = [
    new Bar('a'),
    new Bar('c'),
    new Bar('b'),
];

uasort($collection, new FooSorter()); //will sort 'a', 'b', 'c'
```


### Filter

You need to extends the class `TRex\Collection\AbstractFilter`.
In the method `invoke`, you have to return the value to compare for each object the collection content.

Note that the TRex filter implements duck typing.
You should create a filter by key to access to the data, and not by type of collection content.
For example, if you want to sort a collection of objects by them property '$foo',
you should call your sorter 'FooSorter', anyway the objects the collection content.

```php
use TRex\Collection\AbstractFilter;

class Bar
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}

// we name the filter with the name of the property $foo, and not the name of the class Bar
class FooFilter extends AbstractFilter
{
    /**
     * @param mixed $object
     * @return mixed
     */
    protected function invoke($object)
    {
        return $object->foo;
    }
}


$collection = [
    new Bar('a'),
    new Bar('b'),
    new Bar('b'),
];

array_filter($collection, new FooFilter('b')); //wil keep only the 'b' ones
```

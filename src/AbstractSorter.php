<?php
namespace TRex\Collection;

abstract class AbstractSorter
{
    const ASC_ORDER = 1;
    const DESC_ORDER = -1;

    /**
     * @var int
     */
    private $order;

    /**
     * @param int $order
     */
    public function __construct($order = self::ASC_ORDER)
    {
        $this->order = $order;
    }

    /**
     * @param mixed $object1
     * @param mixed $object2
     * @return int
     */
    public function __invoke($object1, $object2)
    {
        return $this->compare($this->invoke($object1), $this->invoke($object2));
    }

    /**
     * calls the property/method/key to extract the value to sort.
     *
     * @param mixed $object
     * @return mixed
     */
    abstract protected function invoke($object);

    /**
     * @param mixed $value1
     * @param mixed $value2
     * @return int
     */
    private function compare($value1, $value2)
    {
        if ($value1 == $value2) {
            return 0;
        }
        return $this->order(($value1 < $value2) ? -1 : 1);
    }

    /**
     * @param int $value
     * @return int
     */
    private function order($value)
    {
        return $this->order * $value;
    }
}


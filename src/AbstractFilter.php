<?php
namespace TRex\Collection;

abstract class AbstractFilter
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var bool
     */
    private $isOneOfTheValues;

    /**
     * @var bool
     */
    private $isStrict;

    /**
     * @param mixed $value
     * @param bool $isOneOfTheValues
     * @param bool $isStrict
     */
    public function __construct($value, $isOneOfTheValues = false, $isStrict = true)
    {
        if ($isOneOfTheValues && !is_array($value)) {
            throw new \InvalidArgumentException('if $isOneOfTheValues is true, $value must be an array');
        }

        $this->value = $value;
        $this->isOneOfTheValues = $isOneOfTheValues;
        $this->isStrict = $isStrict;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function __invoke($object)
    {
        $value = $this->invoke($object);

        if ($this->isOneOfTheValues) {
            return in_array($value, $this->value, $this->isStrict);
        }

        if ($this->isStrict) {
            return $value === $this->value;
        }

        return $value == $this->value;
    }

    /**
     * @param mixed $object
     * @return mixed
     */
    abstract protected function invoke($object);
}


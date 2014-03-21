<?php

namespace QuoreFun\Service\Validation\Constraint;

/**
 * @Annotation
 */
class LengthConstraint implements Constraint
{
    /**
     * Max string length allowed
     * @var int
     */
    private $length;

    public function __construct($values)
    {
        $this->length = $values['length'];
    }

    public function getMessage()
    {
        return sprintf('Value can not be greater then %s characters', $this->length);
    }

    public function isValid($property)
    {
        return strlen($property) <= $this->length;
    }
}
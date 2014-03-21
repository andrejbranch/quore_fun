<?php

namespace QuoreFun\Service\Validation\Constraint;

/**
 * @Annotation
 */
class PhoneConstraint implements Constraint
{
    public function getMessage()
    {
        return 'Phone numbers must be in the format ###-###-####';
    }

    public function isValid($property)
    {
        return preg_match('/^\d{3}\-\d{3}-\d{4}$/', $property);
    }
}
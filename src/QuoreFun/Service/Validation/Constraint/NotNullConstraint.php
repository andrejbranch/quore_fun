<?php

namespace QuoreFun\Service\Validation\Constraint;

/**
 * @Annotation
 */
class NotNullConstraint implements Constraint
{
    public function getMessage() {
        return 'This value is required';
    }

    public function isValid($property)
    {
        return !is_null($property) && strlen($property) !== 0;
    }
}
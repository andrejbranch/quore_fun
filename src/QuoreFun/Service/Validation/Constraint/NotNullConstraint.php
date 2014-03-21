<?php

namespace QuoreFun\Service\Validation\Constraint;

class NotNullConstraint implements Constraint
{
    public function getMessage() {
        return 'This value is required';
    }

    public function setParams(array $params)
    {
    }

    public function isValid($property)
    {
        return !is_null($property) && strlen($property) !== 0;
    }
}
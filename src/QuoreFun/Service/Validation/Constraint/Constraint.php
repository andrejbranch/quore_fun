<?php

namespace QuoreFun\Service\Validation\Constraint;

interface Constraint
{
    public function isValid($property);
    public function getMessage();
}
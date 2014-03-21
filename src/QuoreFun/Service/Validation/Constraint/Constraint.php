<?php

namespace QuoreFun\Service\Validation\Constraint;

interface Constraint
{
    public function setParams(array $params);
    public function isValid($property);
    public function getMessage();
}
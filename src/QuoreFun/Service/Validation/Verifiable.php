<?php

namespace QuoreFun\Service\Validation;

interface Verifiable
{
    public function getPropertyValidators();
    public function setErrors($errors);
}
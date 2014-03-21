<?php

namespace QuoreFun\Service\Validation\Constraint;

class LengthConstraint implements Constraint
{
    /**
     * Max string length allowed
     * @var int
     */
    private $length;

    public function getMessage() {
        return sprintf('Value can not be greater then %s characters', $this->length);
    }

    public function setParams(array $params)
    {
        if (!isset($params['length'])) {
            throw new \InvalidArgumentException('Params argument must have length specified');
        }

        $this->length = $params['length'];
    }

    public function isValid($property)
    {
        return strlen($property) <= $this->length;
    }
}
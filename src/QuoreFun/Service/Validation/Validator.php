<?php

namespace QuoreFun\Service\Validation;

class Validator implements ValidatorInterface
{
    /**
     * Array of errors mapped to object property
     *
     * @var array format is:
     *      array (
     *          $propertyName1 => $errorMessage1,
     *          $propertyName2 => $errorMessage2,
     *      )
     */
    protected $errors = array();

    public function isValid($object)
    {
        $this->validate($object);

        return count($this->errors) === 0;
    }

    private function validate($object)
    {
        if (!$object instanceof Verifiable) {
            throw new \InvalidArgumentException('Object must implement class Verifiable');
        }

        foreach ($object->getPropertyValidators() as $params) {
            $propertyName = $params['property'];
            $constraint = $this->getContstraintFromParams($params);
            $propertyValue = $this->getPropertyValue($object, $propertyName);

            if (!$constraint->isValid($propertyValue) && !isset($this->errors[$propertyName])) {
                $this->errors[$propertyName] = $constraint->getMessage();
            }
        }
    }

    private function getContstraintFromParams($params)
    {
        if (!isset($params['constraint'])) {
            throw new \InvalidArgumentException('Constraint must be specified');
        }

        $constraintClass = sprintf('%s%s','QuoreFun\\Service\\Validation\\Constraint\\', $params['constraint']);
        $constraint = new $constraintClass;
        $constraint->setParams($params);

        return $constraint;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * assumes that the property has a getter method
     */
    private function getPropertyValue($object, $propertyName)
    {
        return call_user_func_array(array($object, sprintf('get%s', ucfirst($propertyName))), array());
    }
}
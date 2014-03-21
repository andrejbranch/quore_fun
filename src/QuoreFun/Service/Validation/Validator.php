<?php

namespace QuoreFun\Service\Validation;

use Doctrine\Common\Annotations\AnnotationReader;
use QuoreFun\Service\Validation\Constraint\Constraint;

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

        $reflClass = new \ReflectionClass(get_class($object));

        $reader = new AnnotationReader();
        foreach ($reflClass->getProperties() as $property) {
            $annotations = $reader->getPropertyAnnotations($property); 
            $propertyName = $property->getName();

            foreach ($annotations as $annotation) {
                $className = get_class($annotation);
                if ($annotation instanceof Constraint) {
                    $constraint = $annotation;
                    $value = $this->getPropertyValue($object, $propertyName);
                    if (!$constraint->isValid($value) && !isset($this->errors[$propertyName])) {
                        $this->errors[$propertyName] = $constraint->getMessage();
                    }
                }
            }
        }
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
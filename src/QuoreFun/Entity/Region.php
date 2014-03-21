<?php

namespace QuoreFun\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use QuoreFun\Service\Validation\Constraint as Assert;
use QuoreFun\Service\Validation\Verifiable;

/**
 * @ORM\Entity(repositoryClass="RegionRepository")
 * @ORM\Table(name="regions")
 */
class Region implements Verifiable
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\LengthConstraint(length=50)
     * @Assert\NotNullConstraint
     */
    protected $name;

    /** @ORM\OneToMany(targetEntity="QuoreFun\Entity\Property", mappedBy="region") */
    protected $properties;

    /**
     * @var array transient
     */
    protected $errors;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function toArray()
    {
        $data = array(
            'id' => $this->id,
            'name' => $this->name,
        );

        if ($this->errors) {
            $data['errors'] = $this->errors;
        }

        return $data;
    }

    public function hydrateFromArray(array $data)
    {
        $this->name = isset($data['name']) ? $data['name'] : null;
    }
}
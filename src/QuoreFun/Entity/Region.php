<?php

namespace QuoreFun\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use QuoreFun\Service\Validation\Verifiable;

/**
 * @Entity(repositoryClass="RegionRepository")
 * @Table(name="regions")
 */
class Region implements Verifiable
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string", length=50) **/
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

    public function getPropertyValidators()
    {
        return array(
            array(
                'property' => 'name',
                'constraint' => 'LengthConstraint',
                'length' => '50',
            ),
            array(
                'property' => 'name',
                'constraint' => 'NotNullConstraint',
            ),
        );
    }
}
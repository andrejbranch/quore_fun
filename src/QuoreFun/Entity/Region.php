<?php

namespace QuoreFun\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="RegionRepository")
 * @Table(name="regions")
 */
class Region
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @ORM\OneToMany(targetEntity="QuoreFun\Entity\Property", mappedBy="region") */
    protected $properties;

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

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
        );
    }

    public function hydrateFromArray(array $data)
    {
        $this->name = $data['name'];
    }
}
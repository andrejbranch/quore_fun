<?php

namespace QuoreFun\Entity;

/**
 * @Entity(repositoryClass="RegionRepository")
 * @Table(name="regions")
 **/
class Region
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
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
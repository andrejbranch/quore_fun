<?php

namespace QuoreFun\Entity;

use QuoreFun\Entity\Region;

/**
 * @Entity(repositoryClass="PropertyRepository")
 * @Table(name="properties")
 */
class Property
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="QuoreFun\Entity\Region", inversedBy="properties")
     * @ORM\JoinColumn(name="regionId", nullable=false)
     */
    protected $region;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $brand;

    /** @Column(type="string") **/
    protected $phone;

    /** @Column(type="string") **/
    protected $url;

    public function setRegion(Region $region)
    {
        $this->region = $region;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'phone' => $this->phone,
            'url' => $this->url,
        );
    }

    public function hydrateFromArray(array $data)
    {
        $this->name = $data['name'];
        $this->brand = $data['brand'];
        $this->phone = $data['phone'];
        $this->url = $data['url'];
    }
}
<?php

namespace QuoreFun\Entity;

use Doctrine\ORM\Mapping AS ORM;
use QuoreFun\Entity\Region;
use QuoreFun\Service\Validation\Constraint as Assert;
use QuoreFun\Service\Validation\Verifiable;

/**
 * @ORM\Entity(repositoryClass="PropertyRepository")
 * @ORM\Table(name="properties")
 */
class Property implements Verifiable
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="QuoreFun\Entity\Region", inversedBy="properties")
     * @ORM\JoinColumn(name="regionId", nullable=false)
     */
    protected $region;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\LengthConstraint(length=50)
     * @Assert\NotNullConstraint()
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\LengthConstraint(length=25)
     * @Assert\NotNullConstraint()
     */
    protected $brand;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\LengthConstraint(length=25)
     * @Assert\NotNullConstraint()
     * @Assert\PhoneConstraint()
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\LengthConstraint(length=255)
     * @Assert\NotNullConstraint()
     */
    protected $url;

    /**
     * @var array transient
     */
    protected $errors;

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

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function toArray()
    {
        $data = array(
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'phone' => $this->phone,
            'url' => $this->url,
        );

        if ($this->errors) {
            $data['errors'] = $this->errors;
        }

        return $data;
    }

    public function hydrateFromArray(array $data)
    {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->brand = isset($data['brand']) ? $data['brand'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
        $this->url = isset($data['url']) ? $data['url'] : null;
    }
}
<?php

namespace QuoreFun\Entity;

use QuoreFun\Entity\Region;
use QuoreFun\Service\Validation\Verifiable;

/**
 * @Entity(repositoryClass="PropertyRepository")
 * @Table(name="properties")
 */
class Property implements Verifiable
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

    /** @Column(type="string", length=50) **/
    protected $name;

    /** @Column(type="string", length=25) **/
    protected $brand;

    /** @Column(type="string", length=25) **/
    protected $phone;

    /** @Column(type="string", length=255) **/
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
        $this->name = $data['name'];
        $this->brand = $data['brand'];
        $this->phone = $data['phone'];
        $this->url = $data['url'];
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
            array(
                'property' => 'brand',
                'constraint' => 'LengthConstraint',
                'length' => '50',
            ),
            array(
                'property' => 'brand',
                'constraint' => 'NotNullConstraint',
            ),
            array(
                'property' => 'phone',
                'constraint' => 'LengthConstraint',
                'length' => '50',
            ),
            array(
                'property' => 'phone',
                'constraint' => 'NotNullConstraint',
            ),
            array(
                'property' => 'url',
                'constraint' => 'LengthConstraint',
                'length' => '50',
            ),
            array(
                'property' => 'url',
                'constraint' => 'NotNullConstraint',
            ),
        );
    }
}
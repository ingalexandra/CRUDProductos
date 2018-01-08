<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryProduct
 *
 * @ORM\Table(name="category_product", uniqueConstraints={@ORM\UniqueConstraint(name="codecategory", columns={"codecategory"}), @ORM\UniqueConstraint(name="namecategory", columns={"namecategory"})})
 * @ORM\Entity
 */
class CategoryProduct
{
    /**
     * @var string
     *
     * @ORM\Column(name="codecategory", type="string", length=255, nullable=false)
     */
    private $codecategory;

    /**
     * @var string
     *
     * @ORM\Column(name="namecategory", type="string", length=255, nullable=false)
     */
    private $namecategory;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set codecategory
     *
     * @param string $codecategory
     *
     * @return CategoryProduct
     */
    public function setCodecategory($codecategory)
    {
        $this->codecategory = $codecategory;

        return $this;
    }

    /**
     * Get codecategory
     *
     * @return string
     */
    public function getCodecategory()
    {
        return $this->codecategory;
    }

    /**
     * Set namecategory
     *
     * @param string $namecategory
     *
     * @return CategoryProduct
     */
    public function setNamecategory($namecategory)
    {
        $this->namecategory = $namecategory;

        return $this;
    }

    /**
     * Get namecategory
     *
     * @return string
     */
    public function getNamecategory()
    {
        return $this->namecategory;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CategoryProduct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return CategoryProduct
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

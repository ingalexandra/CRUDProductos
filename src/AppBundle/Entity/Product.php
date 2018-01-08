<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product", uniqueConstraints={@ORM\UniqueConstraint(name="codeproduct", columns={"codeproduct"}), @ORM\UniqueConstraint(name="nameproduct", columns={"nameproduct"})}, indexes={@ORM\Index(name="product_ibfk_1", columns={"category"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="codeproduct", type="string", length=20, nullable=false)
     */
    private $codeproduct;

    /**
     * @var string
     *
     * @ORM\Column(name="nameproduct", type="string", length=255, nullable=false)
     */
    private $nameproduct;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=false)
     */
    private $brand;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\CategoryProduct
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoryProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;



    /**
     * Set codeproduct
     *
     * @param string $codeproduct
     *
     * @return Product
     */
    public function setCodeproduct($codeproduct)
    {
        $this->codeproduct = $codeproduct;

        return $this;
    }

    /**
     * Get codeproduct
     *
     * @return string
     */
    public function getCodeproduct()
    {
        return $this->codeproduct;
    }

    /**
     * Set nameproduct
     *
     * @param string $nameproduct
     *
     * @return Product
     */
    public function setNameproduct($nameproduct)
    {
        $this->nameproduct = $nameproduct;

        return $this;
    }

    /**
     * Get nameproduct
     *
     * @return string
     */
    public function getNameproduct()
    {
        return $this->nameproduct;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
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

    /**
     * Set category
     *
     * @param \AppBundle\Entity\CategoryProduct $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\CategoryProduct $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\CategoryProduct
     */
    public function getCategory()
    {
        return $this->category;
    }
}

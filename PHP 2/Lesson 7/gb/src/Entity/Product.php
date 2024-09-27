<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;


    public function getId() : ?int
    {

        return $this->id;
    }

    public function getTitle() : ?string
    {

        return $this->title;
    }

    public function setTitle(string $title) : self
    {

        $this->title = $title;

        return $this;
    }

    public function getDescription() : ?string
    {

        return $this->description;
    }

    public function setDescription(string $description) : self
    {

        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {

        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {

        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {

        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {

        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {

        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {

        $this->image = $image;
    }
}

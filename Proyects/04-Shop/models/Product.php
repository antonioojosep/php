<?php
class Product
{

    private $id;
    private $name;
    private $description;
    private $image;
    private $stock;
    private $price;


    public function __construct($id, $name, $description, $image, $stock, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->stock = $stock;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getStock()
    {
        return $this->stock;
    }

}

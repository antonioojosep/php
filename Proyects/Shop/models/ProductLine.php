<?php
class ProductLine {
    private $id;
    private $name;
    private $amount;
    private $price;

    public function __construct($id,$name,$amount,$price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getId() {
        return $this->id;
    }
}
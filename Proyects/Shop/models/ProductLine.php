<?php
class ProductLine {
    private $id_product;
    private $id_cashorder;
    private $name;
    private $amount;
    private $price;

    public function __construct($id_product,$id_cashorder,$name,$amount,$price)
    {
        $this->id_product = $id_product;
        $this->id_cashorder = $id_cashorder;
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

    public function getIdProduct() {
        return $this->id_product;
    }

    public function getIdCashOrder() {
        return $this->id_cashorder;
    }

    public function getPrice() {
        return $this->price;
    }
}
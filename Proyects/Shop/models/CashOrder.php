<?php
class CashOrder {
    private $id;
    private $username;
    private $date;
    private $status;
    private $address;


    public function __construct($id,$username,$date,$status,$address) {
        $this->id = $id;
        $this->username = $username;
        $this->date = $date;
        $this->status = $status;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getAddress() {
        return $this->address;
    }
}
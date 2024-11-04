<?php
class CashOrder {
    private $id;
    private $username;
    private $address;
    private $completed;


    public function __construct($id,$username) {
        $this->id = $id;
        $this->username = $username;
        $this->completed = false;
        
    }

    public function setCompleted($address) {
        $this->completed = true;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCompleted() {
        return $this->completed;
    }
}
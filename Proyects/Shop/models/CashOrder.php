<?php
class CashOrder {
    private $id;
    private $username;
    private $date;
    private $completed;


    public function __construct($id,$username) {
        $this->id = $id;
        $this->username = $username;
        $this->completed = false;
        
    }

    public function setCompleted() {
        $this->completed = true;
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

    public function getCompleted() {
        return $this->completed;
    }
}
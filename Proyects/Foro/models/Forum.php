<?php

class Forum {
    private $id;
    private $name;
    private $public;

    public function __construct($id, $name,$public)
    {
        $this->id = $id;
        $this->name = $name;
        $this->public = $public;
    }

    public function __get($property)
    {
        if (property_exists($this,$property)) {
            return $this->$property;
        }
    }
}
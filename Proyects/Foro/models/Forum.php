<?php

class Forum {
    private $name;
    private $public;

    public function __construct($name,$public)
    {
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
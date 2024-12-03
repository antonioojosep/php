<?php

class Forum {
    private $id;
    private $name;
    private $type;

    public function __construct($id, $name,$type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function __get($property)
    {
        if (property_exists($this,$property)) {
            return $this->$property;
        }
    }
}
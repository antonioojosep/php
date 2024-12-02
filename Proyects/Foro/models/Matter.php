<?php
class Matter {

    private $id;
    private $name;
    private $public;
    private $forum;

    public function __construct($id, $name,$public,$forum)
    {
        $this->id = $id;
        $this->name = $name;
        $this->public = $public;
        $this->forum = $forum;
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}
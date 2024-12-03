<?php
class Matter {

    private $id;
    private $name;
    private $status;
    private $forum;

    public function __construct($id, $name,$status,$forum)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->forum = $forum;
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}
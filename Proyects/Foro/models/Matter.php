<?php
class Matter {

    private $name;
    private $public;
    private $forum;

    public function __construct($name,$public,$forum)
    {
        $this->name = $name;
        $this->public = $public;
        $this->forum = $forum;
    }
}
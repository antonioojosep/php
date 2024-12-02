<?php
class Response {
    private $id;
    private $text;
    private $public;
    private $matter;
    private $user;

    public function __construct($id,$text,$public,$matter,$user)
    {
        $this->id = $id;
        $this->text = $text;
        $this->public = $public;
        $this->matter = $matter;
        $this->user = $user;
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}
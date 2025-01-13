<?php
class Response {
    private $id;
    private $text;
    private $status;
    private $matter;
    private $user;

    public function __construct($id,$text,$status,$matter,$user)
    {
        $this->id = $id;
        $this->text = $text;
        $this->status = $status;
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
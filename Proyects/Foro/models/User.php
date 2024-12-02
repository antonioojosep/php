<?php
class User {

    private $nickname;
    private $avatar;
    private $email;
    private $type;

    public function __construct($nickname,$avatar,$email,$type)
    {
        $this->nickname = $nickname;
        $this->avatar = $avatar;
        $this->email = $email;
        $this->type = $type;
    }

    public function __get($property)
    {
        if (property_exists($this,$property)) {
            return $this->$property;
        }
    }

}
<?php
class User {

    private $nickname;
    private $avatar;
    private $email;
    private $type;
    private $status;

    public function __construct($nickname,$avatar,$email,$type,$status)
    {
        $this->nickname = $nickname;
        $this->avatar = $avatar;
        $this->email = $email;
        $this->type = $type;
        $this->status = $status;
    }

    public function __get($property)
    {
        if (property_exists($this,$property)) {
            return $this->$property;
        }
    }

}
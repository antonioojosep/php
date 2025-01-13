<?php
class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $role;

    public function __construct($id,$username,$email,$role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}
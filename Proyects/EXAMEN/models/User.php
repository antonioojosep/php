<?php
class User
{
    private int $id;
    private string $username;
    private string $role;
    private array $practices = array();

    public function __construct(int $id, string $username, string $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getPractice(){
        if ($this->role == 'teacher') {
            return PracticeRepository::getPracticeByTeacherId($this->id);
        }elseif ($this->role == 'user') {
            return PracticeRepository::getPracticeByUserId($this->id);
        } else {
            return array();
        }
    }
}
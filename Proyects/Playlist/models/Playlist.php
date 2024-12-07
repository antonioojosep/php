<?php
class Playlist
{
    private int $id;
    private string $title;
    private User $user;

    public function __construct(int $id, string $title, int $userId )
    {
        $this->id = $id;
        $this->title = $title;
        $this->user = UserRepository::getUserByUserId($userId);
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }

}
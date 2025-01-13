<?php

class Song
{
    private  $id;
    private  $title;
    private  $author;
    private  $duration;
    private  $mp3;
    private  $ownerId;

    public function __construct($id,  $title, $author, $duration, $owner, string $mp3 = "default.mp3")
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->duration = $duration;
        $this->mp3 = $mp3 || "default.mp3";
        $this->ownerId = $owner;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function getMp3()
    {
        return $this->mp3;
    }
    public function getOwner()
    {
        return UserRepository::getUserById($this->ownerId);
    }





    public function __toString()
    {
        return $this->title;
    }

    public function __serialize(): array
    {
        return array('id', 'title');
    }

    public function __invoke($pl)
    {
        return $pl->getName();
    }
}

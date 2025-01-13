<?php
class Song
{
    private int $id;
    private string $title;
    private string $author;
    private int $length;
    private string $fyle;

    public function __construct(int $id,string $title, string $author, int $length, string $fyle)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->length = $length;
        $this->fyle = $fyle;
    }

    public function getLength()
    {
        $result = $this->length * (1/60);
        return str_replace(".",":",$result);
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }

}
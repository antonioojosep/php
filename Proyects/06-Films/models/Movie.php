<?php

class Movie
{
    private $id;
    private $title;
    private $year;
    private $poster;
    private $genero;

    public function __construct($id, $title, $year, $poster, $genero)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->poster = $poster;
        $this->genero = $genero;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public static function getNameById($id){
        $db = Connection::connect();
        $q = "SELECT title FROM movie WHERE id = $id";
        $result = $db->query($q);
        return $result->fetch_object()->title;
    }
}

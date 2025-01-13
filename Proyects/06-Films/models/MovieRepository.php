<?php

class MovieRepository
{

    public static function getMoviesByTitle($search)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM movie where title LIKE '%" . $search . "%'";
        $result = $db->query($q);

        while ($row = $result->fetch_assoc()) {
            $movies[] = new Movie($row['id'], $row['title'], $row['year'], $row['poster'], $row['genero']);
        }

        return $movies;
    }
    public static function getMovies()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM movie";
        $result = $db->query($q);

        while ($row = $result->fetch_assoc()) {
            $movies[] = new Movie($row['id'], $row['title'], $row['year'], $row['poster'],$row['genero']);
        }

        return $movies;
    }

    public static function addMovie($title, $year, $poster, $genero)
    {
        $db = Connection::connect();
        $q = "INSERT INTO movie (title, year, poster, genero) VALUES ('$title', '$year', '$poster', '$genero')";
        $db->query($q);
        return $db->insert_id;
    }

    public static function deleteMovie($id)
    {
        $db = Connection::connect();
        $q = "DELETE FROM movie WHERE id = $id";
        $db->query($q);
        return $db->affected_rows;
    }

    
}

<?php
class FavoritesRepository {

    public static function getAllFavoritesByUser($user) {
        $connect = Connection::connect();
        $query = "SELECT * FROM favorites WHERE user_username = '$user'";
        $result = $connect->query($query);
        $favorites = [];
      while ($row = $result->fetch_assoc()) {
        $favorites[] = new Favorites($row['user_username'], $row['movie_id']);
      }
      return $favorites;
    }
    
    public static function addFavorite($user, $movieId) {
        $connect = Connection::connect();
        $query = "INSERT INTO favorites (user_username, movie_id) VALUES ('$user', $movieId)";
        $connect->query($query);
    
        return $connect->insert_id;
    }

    public static function getAllFavoritesByMovieId($movieId) {
        $connect = Connection::connect();
        $query = "SELECT * FROM favorites WHERE movie_id = $movieId";
        $result = $connect->query($query);
        $favorites = [];
        while ($row = $result->fetch_assoc()) {
            $favorites[] = new Favorites($row['user_username'], $row['movie_id']);
        }
        return $favorites;
    }
}


?>
<?php

class CommentRepository {

    public static function getComments($movieId) {
        $db = Connection::connect();
        $query = "SELECT * FROM comment WHERE movie_id = $movieId";
        $result = $db->query($query);
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = new Comment( $row["user"], $row["movie_id"], $row["text"], $row["created_at"]);
        }
        return $comments;
    }

    public static function getCommentsByUser($user) {
        $db = Connection::connect();
        $query = "SELECT * FROM comment WHERE user = '$user'";
        $result = $db->query($query);
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = new Comment( $row["user"], $row["movie_id"], $row["text"], $row["created_at"]);
        }
        return $comments;
    }

    public static function addComment(Comment $comment) {
        $db = Connection::connect();
        $query = "INSERT INTO comment (user, movie_id, text) VALUES ('".$comment->getuser()."',". $comment->getMovieId().", '".$comment->getComment()."')";
        $db->query($query);
    }
}
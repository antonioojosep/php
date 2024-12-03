<?php
class ResponseRepository
{
    public static function addResponse($text,$matter,$user)
    {
        $db = Connection::connect();
        $q = "INSERT INTO response (`text`,`matter`,`user`) VALUES ('$text','$matter','$user')";
        $db->query($q);
    }

    public static function statusHandler($id,$status)
        {
            $db = Connection::connect();
            if ($status == 'inactive') {
                $q = "UPDATE response set status='active' WHERE id='$id'";
            }else {
                $q = "UPDATE response set status='inactive' WHERE id='$id'";
            }
            $db->query($q);
            }
}
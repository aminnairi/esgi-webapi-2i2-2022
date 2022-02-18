<?php

class PhotoModel
{
    public static function fetchAll()
    {
        include "./database/connection.php";
        $getPhotosQuery = $databaseConnection->query("SELECT * FROM photos;");
        $photos = $getPhotosQuery->fetchAll();
        return $photos;
    }
}

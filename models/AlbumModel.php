<?php

class AlbumModel
{
    public static function fetchAll()
    {
        include "./database/connection.php";
        $getAlbumsQuery = $databaseConnection->query("SELECT * FROM albums");
        $albums = $getAlbumsQuery->fetchAll();
        return $albums;
    }
}

<?php

include __DIR__ . "/../database/connection.php";

class AlbumModel
{
    public static function fetchAll()
    {
        $databaseConnection = Database::getConnection();
        $getAlbumsQuery = $databaseConnection->query("SELECT * FROM albums");
        $albums = $getAlbumsQuery->fetchAll();
        return $albums;
    }

    public static function create($albumToCreate)
    {
        $databaseConnection = Database::getConnection();
        $createAlbumQuery = $databaseConnection->prepare("INSERT INTO albums(userId, title) VALUES(:userId, :title);");

        $createAlbumQuery->execute([
            "userId" => $albumToCreate["userId"],
            "title" => $albumToCreate["title"]
        ]);
    }
}

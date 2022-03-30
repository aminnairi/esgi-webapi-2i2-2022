<?php

include __DIR__ . "/../database/connection.php";

class PhotoModel
{
    public static function fetchAll()
    {
        $databaseConnection = Database::getConnection();
        $getPhotosQuery = $databaseConnection->query("SELECT * FROM photos;");
        $photos = $getPhotosQuery->fetchAll();
        return $photos;
    }

    public static function create($photoToCreate)
    {
        $databaseConnection = Database::getConnection();
        $createPhotoQuery = $databaseConnection->prepare("INSERT INTO photos(albumId, title, url, thumbnailUrl) VALUES(:albumId, :title, :url, :thumbnailUrl);");

        $createPhotoQuery->execute([
            "albumId" => $photoToCreate["albumId"],
            "title" => $photoToCreate["title"],
            "url" => $photoToCreate["url"],
            "thumbnailUrl" => $photoToCreate["thumbnailUrl"]
        ]);
    }
}

<?php

include "./library/response.php";
include "./models/PhotoModel.php";

final class Photo
{
    /**
     * @example
     * Photo::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        try {
            $photos = PhotoModel::fetchAll();
            $body = ["success" => true, "photos" => $photos];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @example
     * Photo::post();
     */
    final public static function post(): void
    {
        $json = json_decode(file_get_contents("php://input"));

        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        $body = [
            "success" => true
        ];

        PhotoModel::create([
            "albumId" => $json->albumId,
            "title" => $json->title,
            "url" => $json->url,
            "thumbnailUrl" => $json->thumbnailUrl
        ]);

        echo Response::json($statusCode, $headers, $body);
    }
}

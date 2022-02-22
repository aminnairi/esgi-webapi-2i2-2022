<?php

include "./library/response.php";
include "./models/PostModel.php";

final class Post
{
    /**
     * @example
     * Post::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        try {
            $posts = PostModel::getAll();
            $body = [ "success" => true, "posts" => $posts ];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @example
     * Post::posts();
     */
    final public static function posts(): void
    {
        $json = json_decode(file_get_contents("php://input"));

        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        $body = [
            "success" => true
        ];

        PostModel::create([
            "userId" => $json->userId,
            "title" => $json->title,
            "body" => $json->body
        ]);

        echo Response::json($statusCode, $headers, $body);
    }
}

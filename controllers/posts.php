<?php

include "./library/response.php";

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
            $posts = [];
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
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        $body = [
            "success" => true
        ];

        echo Response::json($statusCode, $headers, $body);
    }
}

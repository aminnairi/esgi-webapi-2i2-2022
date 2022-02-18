<?php

include "./library/response.php";

final class Album
{
    /**
     * @example
     * Album::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        try {
            $albums = [];
            $body = ["success" => true, "albums" => $albums];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @example
     * Album::post();
     */
    final public static function post(): void
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


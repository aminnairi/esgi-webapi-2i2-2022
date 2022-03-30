<?php

include __DIR__ . "/../library/response.php";
include __DIR__ . "/../models/CommentModel.php";

final class Comment
{
    /**
     * @example
     * Comment::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        try {
            $comments = CommentModel::fetchAll();
            $body = ["success" => true, "comments" => $comments];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @example
     * Comment::post();
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

        CommentModel::create([
            "postId" => $json->postId,
            "name" => $json->name,
            "email" => $json->email,
            "body" => $json->body
        ]);

        echo Response::json($statusCode, $headers, $body);
    }
}

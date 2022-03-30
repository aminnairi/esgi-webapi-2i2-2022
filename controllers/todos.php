<?php

include __DIR__ . "/../library/response.php";
include __DIR__ . "/../models/TodoModel.php";

final class Todo
{
    /**
     * @example
     * Todo::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        try {
            $todos = TodoModel::fetchAll();
            $body = ["success" => true, "todos" => $todos];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @example
     * Todo::post();
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

        TodoModel::create([
            "userId" => $json->userId,
            "title" => $json->title,
            "completed" => $json->completed
        ]);

        echo Response::json($statusCode, $headers, $body);
    }
}

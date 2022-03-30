<?php

include __DIR__ . "/../database/connection.php";

class TodoModel
{
    public static function fetchAll()
    {
        $databaseConnection = Database::getConnection();
        $getTodosQuery = $databaseConnection->query("SELECT * FROM todos;");
        $todos = $getTodosQuery->fetchAll();
        return $todos;
    }

    public static function create($todoToCreate)
    {
        $databaseConnection = Database::getConnection();
        $createTodoQuery = $databaseConnection->prepare("INSERT INTO todos(userId, title, completed) VALUES(:userId, :title, :completed);");

        $createTodoQuery->execute([
            "userId" => $todoToCreate["userId"],
            "title" => $todoToCreate["title"],
            "completed" => (int) $todoToCreate["completed"]
        ]);
    }
}

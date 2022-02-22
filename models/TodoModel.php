<?php

class TodoModel
{
    public static function fetchAll()
    {
        include "./database/connection.php";
        $getTodosQuery = $databaseConnection->query("SELECT * FROM todos;");
        $todos = $getTodosQuery->fetchAll();
        return $todos;
    }

    public static function create($todoToCreate)
    {
        include "./database/connection.php";

        $createTodoQuery = $databaseConnection->prepare("INSERT INTO todos(userId, title, completed) VALUES(:userId, :title, :completed);");

        $createTodoQuery->execute([
            "userId" => $todoToCreate["userId"],
            "title" => $todoToCreate["title"],
            "completed" => (int) $todoToCreate["completed"]
        ]);
    }
}

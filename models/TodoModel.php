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
}

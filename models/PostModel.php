<?php

include "./database/connection.php";

class PostModel
{
    public static function getAll()
    {
        $databaseConnection = Database::getConnection();
        $getPostsQuery = $databaseConnection->query("SELECT * FROM posts;");
        $posts = $getPostsQuery->fetchAll();
        return $posts;
    }

    public static function create($postToCreate)
    {
        $databaseConnection = Database::getConnection();
        $createPostQuery = $databaseConnection->prepare("INSERT INTO posts(userId, title, body) VALUES(:userId, :title, :body);");

        $createPostQuery->execute([
            "userId" => $postToCreate["userId"],
            "title" => $postToCreate["title"],
            "body" => $postToCreate["body"]
        ]);
    }
}

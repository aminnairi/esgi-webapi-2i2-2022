<?php

include "./database/connection.php";

class CommentModel
{
    public static function fetchAll()
    {
        $databaseConnection = Database::getConnection();
        $getCommentsQuery = $databaseConnection->query("SELECT * FROM comments;");
        $comments = $getCommentsQuery->fetchAll();
        return $comments;
    }

    public static function create($commentToCreate)
    {
        $databaseConnection = Database::getConnection();
        $createCommentQuery = $databaseConnection->prepare("INSERT INTO comments(postId, name, email, body) VALUES(:postId, :name, :email, :body);");

        $createCommentQuery->execute([
            "postId" => $commentToCreate["postId"],
            "name" => $commentToCreate["name"],
            "email" => $commentToCreate["email"],
            "body" => $commentToCreate["body"]
        ]);
    }
}

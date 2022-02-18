<?php

class CommentModel
{
    public static function fetchAll()
    {
        include "./database/connection.php";
        $getCommentsQuery = $databaseConnection->query("SELECT * FROM comments;");
        $comments = $getCommentsQuery->fetchAll();
        return $comments;
    }
}

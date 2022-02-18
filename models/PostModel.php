<?php


class PostModel
{
    public static function getAll()
    {
        include "./database/connection.php";
        $getPostsQuery = $databaseConnection->query("SELECT * FROM posts;");
        $posts = $getPostsQuery->fetchAll();
        return $posts;
    }
}

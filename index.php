<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * @see https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
 */
$route = $_REQUEST["route"] ?? "home";

/**
 * @see https://www.php.net/manual/en/reserved.variables.server.php
 */
$method = $_SERVER["REQUEST_METHOD"];

if ($route === "users") {
    include "./controllers/users.php";

    if ($method === "GET") {
        User::get();
        die();
    }

    if ($method === "POST") {
        User::post();
        die();
    }
}

if ($route === "posts") {
    include "./controllers/posts.php";

    if ($method === "GET") {
        Post::get();
        die();
    }

    if ($method === "POST") {
        Post::posts();
        die();
    }
}

if ($route === "comments") {
    include "./controllers/comments.php";

    if ($method === "GET") {
        Comment::get();
        die();
    }

    if ($method === "POST") {
        Comment::post();
        die();
    }
}

if ($route === "todos") {
    include "./controllers/todos.php";

    if ($method === "GET") {
        Todo::get();
        die();
    }

    if ($method === "POST") {
        Todo::post();
        die();
    }
}

if ($route === "albums") {
    include "./controllers/albums.php";

    if ($method === "GET") {
        Album::get();
        die();
    }

    if ($method === "POST") {
        Album::post();
        die();
    }
}

if ($route === "photos") {
    include "./controllers/photos.php";

    if ($method === "GET") {
        Photo::get();
        die();
    }

    if ($method === "POST") {
        Photo::post();
        die();
    }
}

echo "Introuvable";

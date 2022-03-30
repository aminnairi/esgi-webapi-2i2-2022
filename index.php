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

if ($route === "login") {
    include __DIR__ . "/controllers/login.php";

    if ($method === "POST") {
        Login::post();
        die();
    }
}

if ($route === "users") {
    include __DIR__ . "/controllers/users.php";

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
    include __DIR__ . "/controllers/posts.php";

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
    include __DIR__ . "/controllers/comments.php";

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
    include __DIR__ . "/controllers/todos.php";

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
    include __DIR__ . "/controllers/albums.php";

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
    include __DIR__ . "/controllers/photos.php";

    if ($method === "GET") {
        Photo::get();
        die();
    }

    if ($method === "POST") {
        Photo::post();
        die();
    }
}

{
    include __DIR__ . "/library/response.php";
    echo Response::json(404, ["Content-Type" => "application/json"], "Not found");
}

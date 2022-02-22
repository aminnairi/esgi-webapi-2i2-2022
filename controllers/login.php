<?php

include "./library/response.php";

class Login
{
    public static function post()
    {
        include "./database/connection.php";

        $json = json_decode(file_get_contents("php://input"));

        $getUserQuery = $databaseConnection->prepare("SELECT * FROM users WHERE email = :email;");

        $getUserQuery->execute([
            "email" => $json->email
        ]);

        $user = $getUserQuery->fetch();

        if (!$user) {
            echo Response::json(400, ["Content-Type" => "application/json"], ["success" => false, "error" => "Bad credentials"]);
            die();
        }

        if (!password_verify($json->password, $user["password"])) {
            echo Response::json(400, ["Content-Type" => "application/json"], ["success" => false, "error" => "Bad credentials"]);
            die();
        }

        $token = bin2hex(random_bytes(64));

        $updateUserTokenQuery = $databaseConnection->prepare("UPDATE users SET token = :token WHERE email = :email;");

        $updateUserTokenQuery->execute([
            "token" => $token,
            "email" => $json->email
        ]);

        echo Response::json(200, ["Content-Type" => "application/json"], ["success" => true, "token" => $token]);
    }
}

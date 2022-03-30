<?php

include __DIR__ . "/../library/response.php";
include __DIR__ . "/../library/headers.php";
include __DIR__ . "/../validations/user.php";
include __DIR__ . "/../models/UserModel.php";

final class User
{
    /**
     * @example
     * User::get();
     */
    final public static function get(): void
    {
        $statusCode = 200;

        $responseHeaders = [
            "Content-Type" => "application/json"
        ];

        if (!Headers::has("token")) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        $token = Headers::get("token");
        $user = UserModel::getOneByToken($token);

        if (!$user) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        if (!UserValidation::isAdministrator($user)) {
            echo Response::json(403, $responseHeaders, ["success" => false, "error" => "Forbidden"]);
            die();
        }

        try {
            $users = UserModel::getAll();
            $body = ["success" => true, "users" => $users];
            echo Response::json($statusCode, $responseHeaders, $body);
        } catch (PDOException $exception) {
            echo Response::json(500, $responseHeaders, ["success" => false, "error" => $exception->getMessage()]);
        }
    }

    /**
     * @example
     * User::post();
     */
    final public static function post(): void
    {
        $statusCode = 200;

        $responseHeaders = [
            "Content-Type" => "application/json"
        ];

        if (Headers::has("token")) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        $token = Headers::get("token");
        $user = UserModel::getOneByToken($token);

        if (!$user) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        if (!UserValidation::isAdministrator($user)) {
            echo Response::json(403, $responseHeaders, ["success" => false, "error" => "Forbidden"]);
            die();
        }

        $json = json_decode(file_get_contents("php://input"));
        $name = $json->name;
        $username = $json->username;
        $website = $json->website;
        $phone = $json->phone;
        $email = $json->email;
        $password = $json->password;
        $role = $json->role;

        UserModel::create([
            "name" => $name,
            "username" => $username,
            "website" => $website,
            "phone" => $phone,
            "email" => $email,
            "password" => $password,
            "role" => $role
        ]);

        $body = [
            "success" => true
        ];

        echo Response::json($statusCode, $responseHeaders, $body);
    }
}


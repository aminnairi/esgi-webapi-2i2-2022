<?php

include "./library/response.php";
include "./models/UserModel.php";

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

        // Factoriser le code

        $requestHeaders = getallheaders();

        if (!isset($requestHeaders["token"])) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        $token = $requestHeaders["token"];

        // Headers::has("token");
        // Headers::get("token");

        $user = UserModel::getOneByToken($token);

        if (!$user) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        // Validation::hasRole("ADMINISTRATOR", $user);

        if ($user["role"] !== "ADMINISTRATOR") {
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

        $requestHeaders = getallheaders();

        if (!isset($requestHeaders["token"])) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        $token = $requestHeaders["token"];
        $user = UserModel::getOneByToken($token);

        if (!$user) {
            echo Response::json(401, $responseHeaders, ["success" => false, "error" => "Unauthorized"]);
            die();
        }

        if ($user["role"] !== "ADMINISTRATOR") {
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


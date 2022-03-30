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

        $headers = [
            "Content-Type" => "application/json"
        ];

        // Récupérer l'en-tête "token" => "4d48b99d4b684b6a1739feea983009fa234918185f6ec8e"
        // Vérifier si un utilisateur existe pour ce token
        // si l'utilisateur n'existe pas (pas connecté), on renvoit une erreur UNAUTHORIZED

        try {
            $users = UserModel::getAll();
            $body = ["success" => true, "users" => $users];
            echo Response::json($statusCode, $headers, $body);
        } catch (PDOException $exception) {
            echo Response::json(500, $headers, ["success" => false, "error" => $exception->getMessage()]);
        }
    }

    /**
     * @example
     * User::post();
     */
    final public static function post(): void
    {
        $statusCode = 200;

        $headers = [
            "Content-Type" => "application/json"
        ];

        $json = json_decode(file_get_contents("php://input"));
        $name = $json->name;
        $username = $json->username;
        $website = $json->website;
        $phone = $json->phone;
        $email = $json->email;
        $password = $json->password;

        UserModel::create([
            "name" => $name,
            "username" => $username,
            "website" => $website,
            "phone" => $phone,
            "email" => $email,
            "password" => $password
        ]);

        $body = [
            "success" => true
        ];

        echo Response::json($statusCode, $headers, $body);
    }
}


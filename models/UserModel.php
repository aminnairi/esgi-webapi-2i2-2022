<?php

include "./database/connection.php";

class UserModel
{
    public static function getAll()
    {
        $databaseConnection = Database::getConnection();
        $getUsersQuery = $databaseConnection->query("SELECT * FROM users;");
        $users = $getUsersQuery->fetchAll();
        return $users;
    }

    public static function create(array $userToCreate)
    {
        $databaseConnection = Database::getConnection();
        $email = $userToCreate["email"];
        $name = $userToCreate["name"];
        $username = $userToCreate["username"];
        $phone = $userToCreate["phone"];
        $website = $userToCreate["website"];
        $password = password_hash($userToCreate["password"], PASSWORD_BCRYPT);
        $role = $userToCreate["role"];

        $createUserQuery = $databaseConnection->prepare("INSERT INTO users(name, username, email, phone, website, password, role) VALUES(:name, :username, :email, :phone, :website, :password, :role);");

        $createUserQuery->execute([
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "phone" => $phone,
            "website" => $website,
            "password" => $password,
            "role" => $role
        ]);
    }

    public static function getOneByToken(string $token)
    {
        $databaseConnection = Database::getConnection();
        $getUserQuery = $databaseConnection->prepare("SELECT role FROM users WHERE token = :token");

        $getUserQuery->execute([
            "token" => $token
        ]);

        $user = $getUserQuery->fetch();

        return $user;
    }
}

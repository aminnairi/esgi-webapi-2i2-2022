<?php

class UserModel
{
    public static function getAll()
    {
        include "./database/connection.php";
        $getUsersQuery = $databaseConnection->query("SELECT * FROM users;");
        $users = $getUsersQuery->fetchAll();
        return $users;
    }

    public static function create(array $userToCreate)
    {
        include "./database/connection.php";

        $email = $userToCreate["email"];
        $name = $userToCreate["name"];
        $username = $userToCreate["username"];
        $phone = $userToCreate["phone"];
        $website = $userToCreate["website"];
        $password = password_hash($userToCreate["password"], PASSWORD_BCRYPT);

        $createUserQuery = $databaseConnection->prepare("INSERT INTO users(name, username, email, phone, website, password) VALUES(:name, :username, :email, :phone, :website, :password);");

        $createUserQuery->execute([
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "phone" => $phone,
            "website" => $website,
            "password" => $password
        ]);
    }

    public static function getOneByToken(string $token)
    {
        include "./database/connection.php";

        $getUserQuery = $databaseConnection->prepare("SELECT token FROM users WHERE token = :token");

        $getUserQuery->execute([
            "token" => $token
        ]);

        $user = $getUserQuery->fetch();

        return $user;
    }
}

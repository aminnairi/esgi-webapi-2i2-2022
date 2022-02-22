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
        $createUserQuery = $databaseConnection->prepare("INSERT INTO users(name, username, email, phone, website, password) VALUES(':name', ':username', ':email', ':phone', ':website', ':password');");
        $createUserQuery->bindParam(":name", $name);
        $createUserQuery->bindParam(":username", $username);
        $createUserQuery->bindParam(":email", $email);
        $createUserQuery->bindParam(":phone", $phone);
        $createUserQuery->bindParam(":website", $website);
        $createUserQuery->bindParam(":password", $password);
        $createUserQuery->execute();
    }
}

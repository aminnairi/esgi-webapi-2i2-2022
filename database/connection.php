<?php

$driver = "mysql";
$databaseName = "esgi-webapi-2i2-2022";
$host = "localhost";
$dsn = "$driver:dbname=$databaseName;host=$host";
$user = "root";
$password = "root";
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$databaseConnection = new PDO($dsn, $user, $password, $options);

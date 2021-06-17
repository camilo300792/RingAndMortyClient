<?php

$dns = 'mysql:dbname=rick_and_morty;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $connection = new PDO($dns, $user, $password);
    return $connection;
} catch (PDOException $exception) {
    var_dump([
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'code' => $exception->getCode()
    ]);
}


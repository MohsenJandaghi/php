<?php

use JetBrains\PhpStorm\NoReturn;

const SERVERNAME = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "instagram";

session_start();

spl_autoload_register(function($class)
{
    $file=str_replace("\\" ,"/" ,"$class.php");   
    require $file;
});

function json(array $data, string $status = 'success')
{
    echo json_encode(
        array_merge($data, ['status' => $status])
    );
    die;
}

#[NoReturn] function dd($data): void
{
    var_dump($data);
    die;
}

function isPost(): bool
{
    return $_SERVER['REQUEST_METHOD'] == "POST";
}

function isGet(): bool
{
    return $_SERVER['REQUEST_METHOD'] == "GET";
}

function controller ($name): string
{
    return "$name.php";
}

function view($name): string
{
    $name = str_replace('.', '/', $name);
    require __DIR__."/views/$name.php";
    return "";
}

function login (\Models\User $user): bool
{
    try {
        $_SESSION['is_login'] = true;
        $_SESSION['user_id'] = $user->id;
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function isLogin(): bool
{
    return isset($_SESSION['is_login']) && $_SESSION['is_login'];
}

function checkLogin (): void
{
    if(!isLogin()) header("Location:Login.php");
}

function user(): \Models\User
{
    return \Models\User::findBy($_SESSION['user_id']);
}
<?php

    require "../config.php";

    if(isLogin())
        header("location:Index.php");

    if(isPost())
        doLogin();

    if(isGet())
        show();

    function show(): void
    {
        view('login');
    }

    function doLogin()
    {
        if(empty($_POST['username']))
            json(["message" => "username is required"], 'error');

        if(empty($_POST['password']))
            json(["message" => "password is required"], 'error');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = \Models\User::findBy($username, 'username');

        if(!$user || $user->password != $password)
            json(["message" => "User not found"], 'error');

        login($user);
        json(["url" => "http://localhost/sa/Controller/Login.php"]);
    }
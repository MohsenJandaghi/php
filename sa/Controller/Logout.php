<?php

    require "../config.php";

    checkLogin();

    if(isGet())
        logout();

    function logout(): void
    {
        unset($_SESSION['is_login']);
        unset($_SESSION['user_id']);
        header("Location:Login.php");
    }
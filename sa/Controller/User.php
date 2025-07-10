<?php

    require "../config.php";

    if(isPost())
        create();

    if(isGet())
        show();

    function create(): void
    {
        \Models\User::create($_POST);
        show();
    }

    function show(): void
    {
        view('users.create');
    }
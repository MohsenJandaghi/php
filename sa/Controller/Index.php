<?php

use Models\Post;
use Models\User;
use Models\Follower;

    require "../config.php";

    checkLogin();

    if(isGet())
        $user_id = $_SESSION['user_id'];
        $item = ['user_id', 'id','users'];
        $user_followers = Follower::where(['followed_id', '=' , $user_id]) -> get();
        $user_followers_arr = [];
        foreach ($user_followers as $item)
        {
            // dd($item);
            $user_followers_arr[] = $item->toArray();
        }
        $users_posts = [];
        foreach ($user_followers_arr as $item)
        {
            if ($item['accept']){
                $user = Post::where(['user_id', '=', $item['user_id']]) -> get();
                $users_posts[] = $user;
            }
        }

        $posts = [];
        
        foreach ($users_posts[0] as $item)
        {
            $posts[] = $item->toArray();
        }
        // dd($posts);
        showProfile();

    function showProfile()
    {
        view('index');
    }

<?php

    require "../config.php";

    checkLogin();

    if(isPost())
        like();

    if(isGet())
        posts();

    function like()
    {
        $post_id = $_POST['post_id'];
        if(\Models\Post::findBy($post_id)->likes()->where(['user_id', '=', user()->id])->count() > 0)
            json([
                'message' => 'You cant like this post. because of already liked posts.'
            ], 'error');

        \Models\Like::create([
            'post_id' => $post_id,
            'user_id' => user()->id
        ]);

        json([
            'message' => 'Your like is done.'
        ]);
    }

    function posts(){
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
    }
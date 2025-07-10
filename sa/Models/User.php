<?php

nameSpace Models;

class User extends Model
{
    public function getFullName(): string
    {
        return "$this->name $this->family <br/>";
    }

    public function posts()
    {
        return Post::where(['user_id', '=', $this->id]);
    }
}
<?php

namespace Models;

use Models\Model;

class Post extends Model
{
    public function user()
    {
        return User::findBy($this->user_id);
    }

    public function likes()
    {
        return Like::where(['post_id', '=', $this->id]);
    }

    public function toArray() : array
    {
        $object_arr = [];
        $object_arr['filter_id'] = $this->filter_id;
        $object_arr['description'] = $this->description;
        $object_arr['file'] = $this->file;
        $object_arr['type'] = $this->type;
        return $object_arr;
    }
}
<?php

namespace Models;

use Models\Model;

class Follower extends Model
{

    public function toArray():array
    {
        $arr = [];
        $arr['user_id'] = $this->user_id;
        $arr['accept'] = $this->accept;

        return $arr;
    }

}
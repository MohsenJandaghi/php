<?php

namespace Models;

class Model
{
    private $attributes = [];

    public function __construct($attributes = null)
    {
        $this->attributes = $attributes;
    }

    public static function all()
    {
        return (new Database(static::class))->get();
    }

    public static function where($condition)
    {
        return (new Database(static::class))
            ->where($condition)
        ;
    }

    public static function whereIn($item)
    {
        return (new Database(static::class))
            ->whereIn($item)
        ;
    }

    public static function create($values)
    {
        $result = (new Database(static::class))->create($values);
        if($result) return self::findBy($result);
        return null;
    }

    public static function findBy($value, $item = 'id')
    {
        $result = self::where([$item, '=', $value])
            ->get();

        if(count($result)) return $result[0];
        return null;
    }

    public function __get($name)
    {
        if(isset($this->attributes[$name]))
            return $this->attributes[$name];

        if(!method_exists($this, $name))
            return null;


        $data = $this->$name();
        if(method_exists($data, 'get'))
            return $data->get();

        return $data;
    }
}
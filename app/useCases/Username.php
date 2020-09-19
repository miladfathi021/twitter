<?php


namespace App\useCases;


class Username
{
    private $attributes;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public static function new($attributes)
    {
        return new static($attributes);
    }

    public function generate()
    {
        $username = explode('@', $this->attributes['email']);

        return $username[0] . rand(10000, 99999);
    }
}

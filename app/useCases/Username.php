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
        $this->attributes['username'] = explode('@', $this->attributes['email'])[0];

        return $this->attributes;
    }
}

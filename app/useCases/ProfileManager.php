<?php


namespace App\useCases;


class ProfileManager
{
    private $attributes;
    private $username;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public static function new($attributes) : self
    {
        return new static($attributes);
    }

    public function addUsername()
    {
        $this->username = Username::new($this->attributes->all())->generate();

        return $this;
    }

    public function create()
    {
        auth()->user()->profile()->create([
            'username' => $this->username
        ]);
    }
}

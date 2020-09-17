<?php

namespace App\Exceptions;

use Throwable;

abstract class CustomException extends \Exception
{
    protected $data;

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}

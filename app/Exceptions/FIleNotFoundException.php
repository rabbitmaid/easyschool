<?php

namespace App\Exceptions;

use Exception;

class FIleNotFoundException extends Exception
{
    public function  __construct($message)
    {
        parent::__construct($message);
    }
}

<?php

namespace App\Exceptions;

use Exception;

class SendNegativeValue extends Exception
{
    //
    public function report()
    {
        \Log::debug('User not found');
    }
}

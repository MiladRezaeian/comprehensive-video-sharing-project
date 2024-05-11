<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class InvalidTypeException extends Exception
{
    public function report()
    {
        Log::error('This is error.');
    }

    public function render()
    {
        return response()->view('exceptions.invalid-type');
    }
}

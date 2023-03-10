<?php

namespace Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class EmptySmsMessageException extends Exception
{
    public function validationException(): ValidationException
    {
        return ValidationException::withMessages([
            'message' => 'Empty message',
        ]);
    }

}

<?php

namespace Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class InvalidTelephoneNumberException extends Exception
{
    public function validationException(): ValidationException
    {
        return ValidationException::withMessages([
            'to' => 'Invalid phone number',
        ]);
    }

}

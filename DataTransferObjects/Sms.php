<?php

namespace DataTransferObjects;


use Illuminate\Http\Request;

class Sms
{
    public function __construct(public string $to, public string $message)
    {
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            to: $request->get('to'),
            message: $request->get('message'),
        );
    }

    public static function fromArray(array $request): static
    {
        return new static(
            to: $request['to'],
            message: $request['message'],
        );
    }
}

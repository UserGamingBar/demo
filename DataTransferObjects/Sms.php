<?php

namespace DataTransferObjects;

class Sms
{
    public function __construct(public string $to, public string $message)
    {
    }

}

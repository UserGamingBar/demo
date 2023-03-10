<?php

namespace Interface;

use DataTransferObjects\Sms;

interface TelesignSmsRepositoryInterface
{
    public function send(Sms $sms): array;
}

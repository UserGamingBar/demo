<?php

namespace Repositories;

use DataTransferObjects\Sms;
use Interface\TelesignSmsRepositoryInterface;
use SmsMessage;
use Throwable;

class TelesignTelesignSmsRepository implements TelesignSmsRepositoryInterface
{
    /**
     * @throws Throwable
     */
    public function send(Sms $sms): array
    {
        return SmsMessage::make()
            ->to($sms->to)
            ->message($sms->message)
            ->using('telesign')
            ->send();
    }

}

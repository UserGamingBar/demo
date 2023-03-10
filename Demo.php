<?php

class Demo
{
    /**
     * @throws Throwable
     */
    public function send(): void
    {
        $to = '1234567890';
        $message = 'New newsletter is available. Please check your email.';

        SmsMessage::make()
            ->to($to)
            ->message($message)
            ->using('telesign')
            ->send();
    }

    /**
     * @throws Throwable
     */
    public function send1(): void
    {
        $to = '1234567890';
        $message = 'New newsletter is available. Please check your email.';

        $telesignService = new TelesignService('foo', 'bar', 'google.com');

        $telesignService->send($to, $message);

    }
}

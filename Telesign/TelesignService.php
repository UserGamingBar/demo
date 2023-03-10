<?php

use Exceptions\EmptySmsMessageException;
use Exceptions\InvalidTelephoneNumberException;
use Exceptions\TelesignApiErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as Status;

class TelesignService
{
    public function __construct(public string $apiKey, public string $apiSecret, public string $endpoint)
    {
    }

    /**
     * @param string $to
     * @param string $message
     * @return JsonResponse
     * @throws Throwable
     */
    public function send(string $to, string $message): JsonResponse
    {
        throw_if(empty($to), new InvalidTelephoneNumberException());

        throw_if(empty($message), new EmptySmsMessageException());

        $response = Http::asForm()->acceptJson()->withBasicAuth($this->apiKey, $this->apiSecret)->post(
            $this->endpoint,
            [
                'phone_number' => $to,
                'message' => $message,
            ]
        );

        if ($response->failed()) {
            throw new TelesignApiErrorException($response->body());
        }

        return response()->json(
            [
                'message' => 'SMS sent successfully'
            ],
            Status::HTTP_OK
        );
    }
}

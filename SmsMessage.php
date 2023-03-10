<?php

use Exceptions\EmptySmsMessageException;
use Exceptions\InvalidSmsProviderException;
use Exceptions\InvalidTelephoneNumberException;
use Exceptions\TelesignApiErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SmsMessage
{
    public string $to;
    public string $message;
    public string $provider;

    public static function make(): static
    {
        return new static;
    }

    public function to($to): static
    {
        $this->to = $to;

        return $this;
    }

    public function message($message): static
    {
        $this->message = $message;

        return $this;
    }

    public function using($provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function send(): array
    {
        throw_if(!in_array($this->provider, ['telesign', 'foo', 'bar']), InvalidSmsProviderException::class);

        match ($this->provider) {
            'telesign' => $response = $this->sendUsingTelesign(),
        };

        return $response;
    }


    /**
     * @throws Throwable
     * @throws ValidationException
     */
    public function sendUsingTelesign(): array
    {
        try {
            $response = (new TelesignService('foo', 'bar', 'google.com'))->send($this->to, $this->message);
        } catch (InvalidTelephoneNumberException $exception) {
            throw $exception->validationException();
        } catch (EmptySmsMessageException $exception) {
            throw $exception->validationException();
        } catch (TelesignApiErrorException $exception) {
            abort(500, $exception->getMessage());
        }

        return $response;
    }
}


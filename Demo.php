<?php


use DataTransferObjects\Sms;
use Illuminate\Http\JsonResponse;
use Interface\TelesignSmsRepositoryInterface;
use Illuminate\Http\Request;

class Demo
{
    public function __construct(public TelesignSmsRepositoryInterface $smsRepository)
    {
    }

    /**
     * @throws Throwable
     */
    public function send(Request $request): JsonResponse
    {
        $result = $this->smsRepository->send(Sms::fromRequest($request));

        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }
}

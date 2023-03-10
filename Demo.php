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
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        $to = $request->get('phone_number');
        $message = $request->get('message');

        $result = $this->smsRepository->send(new Sms($to, $message));

        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }
}

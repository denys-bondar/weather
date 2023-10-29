<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Twilio\Rest\Client;

class NotificationService
{
    use ApiResponser;

    public function __construct()
    {
    }

    public function sendSms(User $user): JsonResponse
    {

            $client = new Client();

            $ss  = $client->messages->create(
                $user->phone,
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => "+13346038347",
                    // the body of the text message you'd like to send
                    'body' => 'Hey Ketav! It’s good to see you after long time!'
                )
            );
            dd($user->phone);
    }

}

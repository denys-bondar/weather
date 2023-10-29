<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Twilio\Rest\Client;

class NotificationService
{
    use ApiResponser;

    public function __construct()
    {
    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function sendSms(User $user, $text = null): void
    {
        $client = new Client();

        $client->messages->create(
            $user->phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => env("TWILIO_FROM"),
                // the body of the text message you'd like to send
                'body' => $text
            )
        );
    }
}

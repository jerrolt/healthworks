<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $authToken = config('services.twilio.auth_token');
        $this->client = new Client($sid, $authToken);
        $this->from = config('services.twilio.phone_number');
    }

    public function sendSms($to, $message)
    {
        try {
            $this->client->messages->create(
                $to, 
                [
                    'from' => $this->from,
                    'body' => $message
                ]
            );

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

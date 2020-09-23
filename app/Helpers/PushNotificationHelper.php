<?php

namespace App\Helpers;

use Pusher\PushNotifications\PushNotifications;

class PushNotificationHelper
{
    // Push notification instance
    private $pushNotifications;

    public function __construct()
    {
        $this->pushNotifications = new PushNotifications(array(
            "instanceId" => config('services.pusher.beams_instance_id'),
            "secretKey" => config('services.pusher.beams_secret_key'),
        ));
    }

    public function send($channel, $message, $data = "")
    {
        $this->pushNotifications->publishToInterests(
            [$channel],
            [
                "apns" => [
                    "aps" => [
                        "alert" => $message
                    ]
                ],
                "fcm" => [
                    "notification" => [
                        "title" => $message,
                        "body" => $data
                    ]
                ]
            ]
        );
    }
}

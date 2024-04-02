<?php

namespace App\Traits;

use App\Jobs\SendGeneralEmail;

trait SendNotification
{


    public function sendNotification($act, $user, $shortcodes, $action = [])
    {
        if (UserEmailNotificationSetup($act, $user)) {
            SendGeneralEmail::dispatch($user, $act, $shortcodes);
        }
        if (UserBrowserNotificationSetup($act, $user)) {
            send_browser_notification($user, $act, $shortcodes,
                $action['actionText'] ?? '',
                $action['actionUrl'] ?? '',
                $action['notificationType'] ?? '',
                $action['id'] ?? '',
            );
        }
        if (UserSmsNotificationSetup($act, $user)) {
            send_sms_notification($user, $type = $act, $shortcodes);
        }
    }
}

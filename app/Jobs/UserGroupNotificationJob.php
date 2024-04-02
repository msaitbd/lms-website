<?php

namespace App\Jobs;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\UserGroup\Entities\UserGroup;


class UserGroupNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $group_id, $user_id = [];

    public function __construct($group_id, $user_id = [])
    {
        $this->group_id = $group_id;
        $this->user_id = $user_id;
    }

    public function handle()
    {

        $group = UserGroup::find($this->group_id);

        $users = User::whereIn('id', $this->user_id)->get();
        if ($users) {

            foreach ($users as $user) {

                if (UserEmailNotificationSetup('USER_GROUP', $user)) {
                    SendGeneralEmail::dispatch($user, 'USER_GROUP', [
                        'user' => $user->name,
                        'group' => $group->title,
                    ]);
                }

                if (UserBrowserNotificationSetup('USER_GROUP', $user)) {
                    send_browser_notification($user, 'USER_GROUP', [
                        'user' => $user->name,
                        'group' => $group->title,
                    ],
                        '',//actionText
                        '',//actionUrl
                    );
                }

                if (UserSmsNotificationSetup('USER_GROUP', $user)) {
                    send_sms_notification($user, 'USER_GROUP', [
                            'user' => $user->name,
                            'group' => $group->title,
                        ]
                    );
                }

                if (UserMobileNotificationSetup('USER_GROUP', $user) && !empty($user->device_token)) {
                    send_mobile_notification($user, 'USER_GROUP', [
                        'user' => $user->name,
                        'group' => $group->title,
                    ], $group->title, $group->id, 'user_group');
                }
            }
        }
    }
}


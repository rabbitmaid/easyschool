<?php

namespace App\Http\Trait;

use App\Models\NotificationComplain;

trait NotifyComplain{

    public static function run(string $type, string $title, int $complain_id, int $user_id, int $admin_id, string $description)
    {
        NotificationComplain::create([
            'type' =>  $type,
            'title' => $title,
            'complain_id' => $complain_id,
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'description' => $description,
            'is_read' => 0,
        ]);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'user_id',
        'admin_id',
        'message',
        'is_read'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function notification_complain_replies()
    {
        return $this->hasMany(NotificationComplainReply::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationComplainReply extends Model
{
    use HasFactory;

    protected $table = 'notification_complain_replies';

    protected $fillable = [
        'type',
        'title',
        'complain_id',
        'user_id',
        'admin_id',
        'description',
        'is_read'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function complain()
    {
        return $this->belongsTo(Complain::class);
    }
}

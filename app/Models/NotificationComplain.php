<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationComplain extends Model
{
    use HasFactory;

    protected $table = 'notification_complains';

    protected $fillable = [
        'type',
        'title',
        'complain_id',
        'user_id',
        'admin_id',
        'description',
        'is_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complain()
    {
        return $this->belongsTo(Complain::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

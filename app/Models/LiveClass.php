<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'live_class_method_id',
        'status_id',
        'class_id',
        'admin_id',
        'start_time',
        'end_time'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function class()
    {
        return $this->belongsTo(Level::class);
    }

    public function live_class_method()
    {
        return $this->belongsTo(LiveClassMethod::class);
    }
}

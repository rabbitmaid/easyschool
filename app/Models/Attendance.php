<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'class_id',
        'is_present',
        'mark_date',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function class()
    {
        return $this->belongsTo(Level::class);
    }
}

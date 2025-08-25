<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'course_id',
        'status_id',
        'gender_id',
        'role_id',
        'password',
        'address',
        'phone_number',
        'date_of_birth',
        'profile_image'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];  

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function classes(): BelongsToMany
    {
        return  $this->BelongsToMany(Level::class, 'admin_class', 'admin_id', 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function complains(){
        return $this->hasMany(Admin::class);
    }

    public function live_classes(){
        return $this->hasMany(LiveClass::class);
    }

    public function complain_replies(){
        return $this->hasMany(ComplainReply::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function notification_complain_replies()
    {
        return $this->hasMany(NotificationComplainReply::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

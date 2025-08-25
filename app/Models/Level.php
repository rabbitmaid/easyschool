<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $table = "classes";


    protected $fillable = [
        'name',
        'description',
        'status_id'
    ];


    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_class', 'admin_id', 'class_id');
    }

    public function students()
    {
        return $this->hasMany(User::class);
    }


    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function live_classes()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assigment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}



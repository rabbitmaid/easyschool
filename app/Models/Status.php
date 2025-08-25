<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;


    public function classes()
    {
        return $this->hasMany(Level::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function courses()
    {
        return  $this->hasMany(Course::class);
    }

    public function methods()
    {
        return $this->hasMany(LiveClassMethod::class);
    }

    public function live_classes()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

}

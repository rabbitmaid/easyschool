<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'class_id',
        'status_id'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function class()
    {
        return $this->belongsTo(Level::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assigment::class);
    }

}

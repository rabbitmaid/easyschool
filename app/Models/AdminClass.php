<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminClass extends Model
{
    use HasFactory;

    protected $table = "admin_class";


    protected $fillable = [
        'admin_id',
        'class_id'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    
}

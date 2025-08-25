<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveClassMethod extends Model
{
    use HasFactory;

    protected $table = 'live_class_methods';

    protected $fillable = [
        'name',
        'description',
        'status_id'
    ];

    
    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function live_classes()
    {
        return $this->hasMany(LiveClass::class);
    }

}

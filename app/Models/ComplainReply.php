<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainReply extends Model
{
    use HasFactory;

    protected $table = 'complain_replies';

    protected $fillable = [
        'complain_id',
        'admin_id',
        'reply'
    ];


    public function admin(){
        return $this->belongsTo(Admin::class);
    }

}

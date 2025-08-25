<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'class_id',
        'course_id',
        'status_id',
        'admin_id',
        'file',
        'start_time',
        'end_time'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function class()
    {
        return $this->belongsTo(Level::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}

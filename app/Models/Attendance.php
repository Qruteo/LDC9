<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_session_id',
        'student_id',
        'status',
        'attendance_time',
        'notes',
    ];

    protected $casts = [
        'attendance_time' => 'datetime',
    ];

    public function classSession()
    {
        return $this->belongsTo(ClassSession::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
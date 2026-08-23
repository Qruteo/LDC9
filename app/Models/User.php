<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi siswa ke kelas
     */
        public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function classes()
    {
        return $this->belongsToMany(
            ClassRoom::class,
            'student_classes',
            'user_id',
            'class_id'
        );
    }


    /**
     * Relasi attendance siswa
     */
    public function attendances()
    {
        return $this->hasMany(
            Attendance::class,
            'student_id'
        );
    }
}
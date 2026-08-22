<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'room',
        'qr_token',
        'latitude',
        'longitude',
    ];

    public function students()
{
    return $this->belongsToMany(
        User::class,
        'student_classes',
        'class_id',
        'user_id'
    );
}
}
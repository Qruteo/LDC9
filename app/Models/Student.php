<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
{
    if (strtolower(Auth::user()->role) !== 'admin') {
        abort(403);
    }

    $students = Student::with([
        'user',
    ])->latest()->get();

    $classes = \App\Models\ClassRoom::orderBy('name')->get();

    return view('auth.admin.siswa.index', compact(
        'students',
        'classes'
    ));
}
}
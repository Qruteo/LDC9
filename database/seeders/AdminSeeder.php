<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@ldc9.com'],
            [
                'name' => 'Admin Utama',
                'password' => bcrypt('admin12345'),
                'role' => 'admin',
            ]
        );

        // 2. Guru Account & Teacher Record
        $guruUser = User::updateOrCreate(
            ['email' => 'guru@ldc9.com'],
            [
                'name' => 'Guru Pengajar',
                'password' => bcrypt('guru12345'),
                'role' => 'guru',
            ]
        );

        $teacher = Teacher::updateOrCreate(
            ['user_id' => $guruUser->id],
            ['teacher_code' => 'GURU001']
        );

        // 3. Class
        $class = ClassRoom::updateOrCreate(
            ['name' => 'XI RPL A'],
            [
                'room' => 'Lab 1',
                'qr_token' => 'QR-XI-RPL-A',
                'latitude' => -6.200000,
                'longitude' => 106.816666,
            ]
        );

        // 4. Siswa Account, Student Record & Class Attachment
        $siswaUser = User::updateOrCreate(
            ['email' => 'siswa@ldc9.com'],
            [
                'name' => 'Siswa Example',
                'nis' => '12345678',
                'password' => bcrypt('siswa12345'),
                'role' => 'siswa',
            ]
        );

        Student::updateOrCreate(
            ['user_id' => $siswaUser->id],
            ['nis' => '12345678']
        );

        if (!$class->students()->where('users.id', $siswaUser->id)->exists()) {
            $class->students()->attach($siswaUser->id);
        }

        // 5. Subject
        $subject = Subject::updateOrCreate(
            ['name' => 'Matematika'],
            ['name' => 'Matematika']
        );

        // 6. Schedule for Today (Indonesian Day)
        $dayMap = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];
        $todayIndo = $dayMap[now()->format('l')];

        Schedule::updateOrCreate(
            [
                'teacher_id' => $teacher->id,
                'class_id' => $class->id,
                'subject_id' => $subject->id,
                'day' => $todayIndo,
            ],
            [
                'start_time' => '00:00:00',
                'end_time' => '23:59:59',
            ]
        );
    }
}
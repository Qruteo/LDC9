<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Attendance;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
class AdminDashboardController extends Controller
{
    /**
     * Pastikan user adalah admin.
     */
    private function checkAdmin()
    {
        if (!Auth::check() || strtolower(Auth::user()->role) !== 'admin') {
            abort(403);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

  public function index()
{
    $this->checkAdmin();

    $totalSiswa = User::whereRaw('LOWER(role) = ?', ['siswa'])->count();

    $totalGuru = User::whereRaw('LOWER(role) = ?', ['guru'])->count();

    $totalKelas = ClassRoom::count();

    $totalMataPelajaran = Subject::count();

    return view('auth.admin.dashboard', compact(
        'totalSiswa',
        'totalGuru',
        'totalKelas',
        'totalMataPelajaran'
    ));
}

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        $this->checkAdmin();

        $students = User::whereRaw("LOWER(role) = 'siswa'")
            ->with('classes')
            ->latest()
            ->get();

        $classes = ClassRoom::orderBy('name')->get();

        return view(
            'auth.admin.siswa.index',
            compact('students', 'classes')
        );
    }
    public function siswaCreate()
{
    $this->checkAdmin();

    $classes = ClassRoom::orderBy('name')->get();

    return view(
        'auth.admin.siswa.create',
        compact('classes')
    );
}

public function siswaStore(Request $request)
{
    $this->checkAdmin();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email',
        ],

        'password' => [
            'required',
            'string',
            'min:6',
        ],

        'class_id' => [
            'nullable',
            'exists:classes,id',
        ],
    ]);

    $student = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'siswa',
    ]);

    if (!empty($validated['class_id'])) {
        $student->classes()->sync([
            $validated['class_id'],
        ]);
    }

    return redirect()
        ->route('admin.siswa')
        ->with('success', 'Siswa berhasil ditambahkan.');
}

public function siswaEdit(User $student)
{
    $this->checkAdmin();

    if (strtolower($student->role) !== 'siswa') {
        abort(404);
    }

    $classes = ClassRoom::orderBy('name')->get();

    $student->load('classes');

    return view(
        'auth.admin.siswa.edit',
        compact('student', 'classes')
    );
}

public function siswaUpdate(Request $request, User $student)
{
    $this->checkAdmin();

    if (strtolower($student->role) !== 'siswa') {
        abort(404);
    }

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email,' . $student->id,
        ],

        'password' => [
            'nullable',
            'string',
            'min:6',
        ],

        'class_id' => [
            'nullable',
            'exists:classes,id',
        ],
    ]);

    $student->name = $validated['name'];
    $student->email = $validated['email'];

    if (!empty($validated['password'])) {
        $student->password = bcrypt($validated['password']);
    }

    $student->save();

    if (!empty($validated['class_id'])) {
        $student->classes()->sync([
            $validated['class_id'],
        ]);
    } else {
        $student->classes()->detach();
    }

    return redirect()
        ->route('admin.siswa')
        ->with('success', 'Data siswa berhasil diperbarui.');
}

public function siswaDestroy(User $student)
{
    $this->checkAdmin();

    if (strtolower($student->role) !== 'siswa') {
        abort(404);
    }

    $student->classes()->detach();
    $student->delete();

    return redirect()
        ->route('admin.siswa')
        ->with('success', 'Siswa berhasil dihapus.');
}


    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */

    public function guru()
    {
        $this->checkAdmin();

        $teachers = User::whereRaw("LOWER(role) = 'guru'")
            ->with('teacher')
            ->latest()
            ->get();

        // Dibutuhkan oleh halaman Data Guru
        $classes = ClassRoom::orderBy('name')->get();

        return view(
            'auth.admin.guru.index',
            compact('teachers', 'classes')
        );
    }

    public function guruCreate()
    {
        $this->checkAdmin();

        $classes = ClassRoom::orderBy('name')->get();

        return view(
            'auth.admin.guru.create',
            compact('classes')
        );
    }

   public function guruStore(Request $request)
{
    $this->checkAdmin();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email',
        ],

        'password' => [
            'required',
            'string',
            'min:6',
        ],

        'teacher_code' => [
            'required',
            'string',
            'max:255',
            'unique:teachers,teacher_code',
        ],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'guru',
    ]);

    Teacher::create([
        'user_id' => $user->id,
        'teacher_code' => $validated['teacher_code'],
    ]);

    return redirect()
        ->route('admin.guru')
        ->with('success', 'Guru berhasil ditambahkan.');
}
    public function guruEdit($teacher)
    {
        $this->checkAdmin();

        $teacher = User::with('teacher')->findOrFail($teacher);

        $classes = ClassRoom::orderBy('name')->get();

        return view(
            'auth.admin.guru.edit',
            compact('teacher', 'classes')
        );
    }

    public function guruUpdate(Request $request, $teacher)
    {
        $this->checkAdmin();

        $user = User::with('teacher')->findOrFail($teacher);
        $teacherRecord = $user->teacher;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
            ],
            'teacher_code' => [
                'required',
                'string',
                'max:255',
                'unique:teachers,teacher_code,' . ($teacherRecord?->id ?? 'NULL'),
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        if ($teacherRecord) {
            $teacherRecord->update([
                'teacher_code' => $validated['teacher_code'],
            ]);
        } else {
            Teacher::create([
                'user_id' => $user->id,
                'teacher_code' => $validated['teacher_code'],
            ]);
        }

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function guruDestroy($teacher)
    {
        $this->checkAdmin();

        $teacher = User::findOrFail($teacher);

        $teacher->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */

    public function kelas()
    {
        $this->checkAdmin();

        $classes = ClassRoom::withCount('students')
            ->withCount('schedules')
            ->orderBy('name')
            ->get();

        return view(
            'auth.admin.kelas.index',
            compact('classes')
        );
    }

    public function kelasCreate()
    {
        $this->checkAdmin();

        return view('auth.admin.kelas.create');
    }

    public function kelasStore(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:classes,name',
            ],

            'room' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        ClassRoom::create([
            'name' => $validated['name'],
            'room' => $validated['room'] ?? null,
            'qr_token' => (string) Str::uuid(),
        ]);

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function kelasEdit(ClassRoom $classRoom)
    {
        $this->checkAdmin();

        $class = $classRoom;

        return view(
            'auth.admin.kelas.edit',
            compact('class')
        );
    }

    public function kelasUpdate(Request $request, ClassRoom $classRoom)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:classes,name,' . $classRoom->id,
            ],

            'room' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $classRoom->update([
            'name' => $validated['name'],
            'room' => $validated['room'] ?? null,
        ]);

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function kelasDestroy(ClassRoom $classRoom)
    {
        $this->checkAdmin();

        $classRoom->delete();

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | SISWA DALAM KELAS
    |--------------------------------------------------------------------------
    */

    public function kelasStudents(ClassRoom $classRoom)
    {
        $this->checkAdmin();

        $students = $classRoom->students()
            ->whereRaw('LOWER(role) = ?', ['siswa'])
            ->orderBy('name')
            ->get();

        return view(
            'auth.admin.kelas.students',
            [
                'classRoom' => $classRoom,
                'students' => $students,
            ]
        );
    }

    public function kelasStudentStore(
        Request $request,
        ClassRoom $classRoom
    ) {
        $this->checkAdmin();

        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ]);

        $student = User::where('id', $validated['student_id'])
            ->whereRaw("LOWER(role) = 'siswa'")
            ->firstOrFail();

        if (!$classRoom->students()->where('users.id', $student->id)->exists()) {
            $classRoom->students()->attach($student->id);
        }

        return redirect()
            ->route('admin.kelas.students', $classRoom)
            ->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }

    public function kelasStudentDestroy(
        ClassRoom $classRoom,
        User $student
    ) {
        $this->checkAdmin();

        $classRoom->students()->detach($student->id);

        return redirect()
            ->route('admin.kelas.students', $classRoom)
            ->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
    }

    /*
|--------------------------------------------------------------------------
| MATA PELAJARAN
|--------------------------------------------------------------------------
*/

public function mataPelajaran()
{
    $this->checkAdmin();

    $subjects = Subject::orderBy('name')->get();

    return view(
        'auth.admin.mata-pelajaran.index',
        compact('subjects')
    );
}

public function mataPelajaranCreate()
{
    $this->checkAdmin();

    return view('auth.admin.mata-pelajaran.create');
}

public function mataPelajaranStore(Request $request)
{
    $this->checkAdmin();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'unique:subjects,name',
        ],
    ]);

    Subject::create([
        'name' => $validated['name'],
    ]);

    return redirect()
        ->route('admin.mata-pelajaran')
        ->with('success', 'Mata pelajaran berhasil ditambahkan.');
}

public function mataPelajaranEdit(Subject $subject)
{
    $this->checkAdmin();

    return view(
        'auth.admin.mata-pelajaran.edit',
        compact('subject')
    );
}

public function mataPelajaranUpdate(
    Request $request,
    Subject $subject
) {
    $this->checkAdmin();

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'unique:subjects,name,' . $subject->id,
        ],
    ]);

    $subject->update([
        'name' => $validated['name'],
    ]);

    return redirect()
        ->route('admin.mata-pelajaran')
        ->with('success', 'Mata pelajaran berhasil diperbarui.');
}

public function mataPelajaranDestroy(Subject $subject)
{
    $this->checkAdmin();

    $subject->delete();

    return redirect()
        ->route('admin.mata-pelajaran')
        ->with('success', 'Mata pelajaran berhasil dihapus.');
}

   /*
|--------------------------------------------------------------------------
| JADWAL
|--------------------------------------------------------------------------
*/

public function jadwal()
{
    $this->checkAdmin();

    $schedules = Schedule::with([
        'teacher.user',
        'classRoom',
        'subject',
    ])
        ->orderByRaw("
            CASE day
                WHEN 'Senin' THEN 1
                WHEN 'Selasa' THEN 2
                WHEN 'Rabu' THEN 3
                WHEN 'Kamis' THEN 4
                WHEN 'Jumat' THEN 5
                WHEN 'Sabtu' THEN 6
                WHEN 'Minggu' THEN 7
                ELSE 8
            END
        ")
        ->orderBy('start_time')
        ->get();

    return view(
        'auth.admin.jadwal.index',
        compact('schedules')
    );
}


public function jadwalCreate()
{
    $this->checkAdmin();

    $teachers = Teacher::with('user')
        ->whereHas('user', function ($query) {
            $query->whereRaw("LOWER(role) = 'guru'");
        })
        ->get()
        ->sortBy(function ($teacher) {
            return strtolower($teacher->user->name ?? '');
        });

    $classes = ClassRoom::orderBy('name')->get();

    $subjects = Subject::orderBy('name')->get();

    $days = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
    ];

    return view(
        'auth.admin.jadwal.create',
        compact(
            'teachers',
            'classes',
            'subjects',
            'days'
        )
    );
}


public function jadwalStore(Request $request)
{
    $this->checkAdmin();

    $validated = $request->validate([
        'teacher_id' => [
            'required',
            'integer',
            'exists:teachers,id',
        ],

        'class_id' => [
            'required',
            'integer',
            'exists:classes,id',
        ],

        'subject_id' => [
            'required',
            'integer',
            'exists:subjects,id',
        ],

        'day' => [
            'required',
            'string',
            'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ],

        'start_time' => [
            'required',
            'date_format:H:i',
        ],

        'end_time' => [
            'required',
            'date_format:H:i',
            'after:start_time',
        ],
    ]);

    Schedule::create($validated);

    return redirect()
        ->route('admin.jadwal')
        ->with('success', 'Jadwal berhasil ditambahkan.');
}


public function jadwalEdit(Schedule $schedule)
{
    $this->checkAdmin();

    $schedule->load([
        'teacher.user',
        'classRoom',
        'subject',
    ]);

    $teachers = Teacher::with('user')
        ->whereHas('user', function ($query) {
            $query->whereRaw("LOWER(role) = 'guru'");
        })
        ->get()
        ->sortBy(function ($teacher) {
            return strtolower($teacher->user->name ?? '');
        });

    $classes = ClassRoom::orderBy('name')->get();

    $subjects = Subject::orderBy('name')->get();

    $days = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
    ];

    return view(
        'auth.admin.jadwal.edit',
        compact(
            'schedule',
            'teachers',
            'classes',
            'subjects',
            'days'
        )
    );
}


public function jadwalUpdate(
    Request $request,
    Schedule $schedule
) {
    $this->checkAdmin();

    $validated = $request->validate([
        'teacher_id' => [
            'required',
            'integer',
            'exists:teachers,id',
        ],

        'class_id' => [
            'required',
            'integer',
            'exists:classes,id',
        ],

        'subject_id' => [
            'required',
            'integer',
            'exists:subjects,id',
        ],

        'day' => [
            'required',
            'string',
            'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ],

        'start_time' => [
            'required',
            'date_format:H:i',
        ],

        'end_time' => [
            'required',
            'date_format:H:i',
            'after:start_time',
        ],
    ]);

    $schedule->update($validated);

    return redirect()
        ->route('admin.jadwal')
        ->with('success', 'Jadwal berhasil diperbarui.');
}


public function jadwalDestroy(Schedule $schedule)
{
    $this->checkAdmin();

    $schedule->delete();

    return redirect()
        ->route('admin.jadwal')
        ->with('success', 'Jadwal berhasil dihapus.');
}

    /*
    |--------------------------------------------------------------------------
    | ABSENSI
    |--------------------------------------------------------------------------
    */

    public function absensi()
    {
        $this->checkAdmin();

        $attendances = Attendance::with([
            'student',
            'classSession.schedule',
            'classSession.teacher',
        ])
            ->latest('attendance_time')
            ->get();

        return view(
            'auth.admin.absensi.index',
            compact('attendances')
        );
    }

    public function absensiExport()
{
    $this->checkAdmin();

    $attendances = Attendance::with([
        'user',
        'classSession.schedule.teacher.user',
        'classSession.schedule.classRoom',
        'classSession.schedule.subject',
    ])
    ->orderByDesc('attendance_time')
    ->get();

    $filename = 'rekap-absensi-' . now()->format('Y-m-d-His') . '.csv';

    return response()->streamDownload(function () use ($attendances) {
        $handle = fopen('php://output', 'w');

        // Header CSV
        fputcsv($handle, [
            'No',
            'Nama Siswa',
            'Kelas',
            'Mata Pelajaran',
            'Guru',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Status',
            'Waktu Absensi',
        ]);

        foreach ($attendances as $index => $attendance) {
            $schedule = $attendance->classSession?->schedule;

            fputcsv($handle, [
                $index + 1,
                $attendance->user?->name ?? '-',
                $schedule?->classRoom?->name ?? '-',
                $schedule?->subject?->name ?? '-',
                $schedule?->teacher?->user?->name ?? '-',
                $schedule?->day ?? '-',
                $schedule?->start_time ?? '-',
                $schedule?->end_time ?? '-',
                $attendance->status ?? '-',
                $attendance->attendance_time ?? '-',
            ]);
        }

        fclose($handle);
    }, $filename, [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
}
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}
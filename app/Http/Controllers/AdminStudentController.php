<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     */
    public function index()
    {
        $this->checkAdmin();

        $students = User::where('role', 'siswa')
            ->with('studentClasses')
            ->orderBy('name')
            ->get();

        return view('auth.admin.siswa.index', compact('students'));
    }


    /**
     * Form tambah siswa.
     */
    public function create()
    {
        $this->checkAdmin();

        $classes = ClassRoom::orderBy('name')->get();

        return view('auth.admin.siswa.create', compact('classes'));
    }


    /**
     * Simpan siswa baru.
     */
    public function store(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'nis' => [
                'required',
                'string',
                'max:50',
                'unique:users,nis',
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
                'confirmed',
            ],

            'class_id' => [
                'required',
                'exists:classes,id',
            ],
        ]);


        DB::transaction(function () use ($validated) {

            $student = User::create([
                'name' => $validated['name'],
                'nis' => $validated['nis'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'siswa',
            ]);


            DB::table('student_classes')->insert([
                'user_id' => $student->id,
                'class_id' => $validated['class_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });


        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    /**
     * Form edit siswa.
     */
    public function edit(User $student)
    {
        $this->checkAdmin();

        if ($student->role !== 'siswa') {
            abort(404);
        }

        $classes = ClassRoom::orderBy('name')->get();

        $student->load('studentClasses');

        $currentClassId = $student->studentClasses
            ->first()
            ?->id;

        return view(
            'auth.admin.siswa.edit',
            compact(
                'student',
                'classes',
                'currentClassId'
            )
        );
    }


    /**
     * Update data siswa.
     */
    public function update(Request $request, User $student)
    {
        $this->checkAdmin();

        if ($student->role !== 'siswa') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'nis' => [
                'required',
                'string',
                'max:50',
                'unique:users,nis,' . $student->id,
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
                'confirmed',
            ],

            'class_id' => [
                'required',
                'exists:classes,id',
            ],
        ]);


        DB::transaction(function () use ($validated, $student) {

            $student->name = $validated['name'];
            $student->nis = $validated['nis'];
            $student->email = $validated['email'];

            if (!empty($validated['password'])) {
                $student->password = Hash::make(
                    $validated['password']
                );
            }

            $student->save();


            // Ganti kelas siswa.
            $student->studentClasses()->sync([
                $validated['class_id']
            ]);
        });


        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }


    /**
     * Hapus siswa.
     */
    public function destroy(User $student)
    {
        $this->checkAdmin();

        if ($student->role !== 'siswa') {
            abort(404);
        }

        DB::transaction(function () use ($student) {

            // Hapus relasi kelas terlebih dahulu.
            $student->studentClasses()->detach();

            // Hapus akun siswa.
            $student->delete();
        });


        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil dihapus.');
    }


    /**
     * Pastikan yang mengakses adalah admin.
     */
    private function checkAdmin(): void
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403);
        }
    }
}
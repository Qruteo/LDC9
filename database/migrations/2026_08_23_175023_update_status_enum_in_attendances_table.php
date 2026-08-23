<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Mengubah ENUM status di tabel attendances agar menerima
     * nilai baru: hadir, izin, sakit, alfa
     * (tetap mempertahankan nilai lama: present, late, absent)
     */
    public function up(): void
    {
        // Cara paling kompatibel untuk mengubah ENUM di MySQL
        // adalah via DB::statement karena Laravel Blueprint::change()
        // tidak mendukung perubahan nilai ENUM secara native.
        DB::statement("
            ALTER TABLE `attendances`
            MODIFY COLUMN `status`
            ENUM('present', 'late', 'absent', 'hadir', 'izin', 'sakit', 'alfa')
            NOT NULL DEFAULT 'hadir'
        ");
    }

    public function down(): void
    {
        // Rollback ke ENUM lama
        DB::statement("
            ALTER TABLE `attendances`
            MODIFY COLUMN `status`
            ENUM('present', 'late', 'absent')
            NOT NULL DEFAULT 'present'
        ");
    }
};

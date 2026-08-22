<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('class_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('schedule_id')
                ->constrained('schedules')
                ->onDelete('cascade');

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->onDelete('cascade');

            $table->date('session_date');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->text('material')->nullable();

            $table->text('notes')->nullable();

            $table->enum('status', [
                'ongoing',
                'completed'
            ])->default('ongoing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('class_sessions');
    }
};
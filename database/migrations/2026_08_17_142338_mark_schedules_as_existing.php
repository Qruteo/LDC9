<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
        $table->id();

        $table->foreignId('schedule_id')
              ->constrained('schedules')
              ->cascadeOnDelete();

        $table->string('schedule_code')->unique();

        $table->timestamps();
    });
    }

    public function down(): void
    {
        //
    }
};
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
        Schema::create(table: 'kelas_details', callback: function (Blueprint $table): void {
            $table->id();
            $table->foreignId(column: 'siswa_id')->constrained(table: 'siswas')->cascadeOnDelete();
            $table->foreignId(column: 'kelas_id')->constrained(table: 'kelas')->cascadeOnDelete();
            $table->foreignId(column: 'tahun_ajar_id')->constrained(table: 'tahun_ajars')->cascadeOnDelete();
            $table->enum(column: 'status', allowed: ['aktif', 'nonaktif'])->default(value: 'aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_details');
    }
};

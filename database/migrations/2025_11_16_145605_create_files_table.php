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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel employees
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade'); 
            
            // Kolom dokumen (Sesuai permintaan Anda)
            $table->string('cv')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('ktp')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('transkrip_nilai')->nullable();
            $table->string('kartu_bpjs')->nullable();
            $table->string('suket_pengalaman_kerja')->nullable();
            $table->string('daftar_riwayat_hidup')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};

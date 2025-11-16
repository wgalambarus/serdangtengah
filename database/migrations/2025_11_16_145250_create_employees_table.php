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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_no')->nullable()->unique();
            $table->string('full_name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L','P'])->nullable();
            $table->string('last_education')->nullable();
            $table->enum('marital_status', ['MENIKAH','DUDA','JANDA','BELUM_MENIKAH'])->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_type', 5)->nullable();


            $table->string('national_id')->nullable()->unique();
            $table->string('npwp')->nullable();
            $table->string('bpjs_tk')->nullable();
            $table->string('bpjs_kes')->nullable();


            $table->string('phone')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relation')->nullable();
            $table->string('emergency_phone')->nullable();


            $table->json('skills')->nullable(); // lightweight JSON for skill keywords
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

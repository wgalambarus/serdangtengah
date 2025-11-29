<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_position_pelamar', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pelamar_id');
            $table->foreign('pelamar_id')
                ->references('id')
                ->on('pelamars')
                ->onDelete('cascade');
            $table->index('pelamar_id');

            $table->unsignedBigInteger('job_position_id');
            $table->foreign('job_position_id')
                ->references('id')
                ->on('job_positions')
                ->onDelete('cascade');
            $table->index('job_position_id');
            $table->float('score')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_position_pelamar');
    }
};

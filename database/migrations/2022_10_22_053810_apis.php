<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fgv_pmps_rosaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('catatan')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();            
            $table->timestamps();         
        });

        Schema::create('fgv_pmps_tugasans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('pekerja_id')->nullable()->constrained('users')->cascadeOnDelete();   
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->cascadeOnDelete();   
            $table->timestamps();         
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

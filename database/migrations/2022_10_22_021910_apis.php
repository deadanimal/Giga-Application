<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();            
     * @return void
     */
    public function up()
    {

        Schema::table('projeks', function (Blueprint $table) {
            $table->foreignId('projek_id')->nullable()->constrained('projeks')->cascadeOnDelete();            
        });

        Schema::table('projek_users', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('namalogin')->nullable();
            $table->string('katalaluan')->nullable();
            $table->foreignId('projek_id')->nullable()->constrained('projeks')->cascadeOnDelete();            
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

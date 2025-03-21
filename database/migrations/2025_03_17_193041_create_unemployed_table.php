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
        Schema::create('unemployed', function (Blueprint $table) {
            $table->id();
            $table->string('resume');
            $table->string('experience');
            $table->string('skills');
            $table->string('education');
            $table->string('availabili0ty');
            $table->unsignedBigInteger('usuario_id'); 
            
            
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unemployed');
    }
};

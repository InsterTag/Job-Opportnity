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
        Schema::create('job_trainings', function (Blueprint $table) {
            $table->id(); 

            $table->string('title');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('description');

            $table->unsignedBigInteger('unemployed_id')->nullable(); 

            $table->foreign('unemployed_id')
            ->references('id')
            ->on('unemployed')
            ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_trainings');
    }
};

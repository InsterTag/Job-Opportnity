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
        Schema::create('job_offers_unemployed', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('unemploy_id')->nullable();
            $table->unsignedBigInteger('job_offers_id')->nullable();

            $table->foreign('unemploy_id')
            ->references('id')
            ->on('unemployed')->onDelete('cascade');

            $table->foreign('job_offers_id')
            ->references('id')
            ->on('job_offers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers_unemployed');
    }
};

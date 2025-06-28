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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
        $table->text('message')->nullable();
        $table->unsignedBigInteger('unemployed_id')->nullable();
        $table->foreign('unemployed_id')->references('id')->on('unemployeds')->onDelete('cascade');

        $table->unsignedBigInteger('job_offer_id')->nullable();
        $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

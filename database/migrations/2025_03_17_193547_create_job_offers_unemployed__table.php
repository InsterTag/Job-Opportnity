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
        Schema::create('job_offers_unemployed_', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('unemployed_id');
            $table->unsignedBigInteger('offer_id');
            
            
            $table->foreign('unemployed_id')->references('unemployed_id')->on('unemployed');
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->timestamps();
        });
    }
       

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers_unemployed_');
    }
};

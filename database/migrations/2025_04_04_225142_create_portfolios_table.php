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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unemployed_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url_proyect');
            $table->string('url_pdf')->nullable();
            $table->timestamps();
    
            $table->foreign('unemployed_id')->references('id')->on('unemployeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

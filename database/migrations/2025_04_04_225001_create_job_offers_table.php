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
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->string('geolocation')->nullable(); // Google Maps string or coordinates
            $table->enum('offer_type', ['contract', 'classified'])->default('contract'); // Tipo de oferta
            $table->timestamps();

            // Clave foránea (opcional, si tienes la tabla companies)
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offer');
    }
};

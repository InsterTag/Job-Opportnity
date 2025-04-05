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

            $table->string('title');
            $table->text('description');
            $table->string('requirements');
            $table->integer('salary');
            $table->string('publication_date');
            $table->string('completion_date');

            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');
                

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers');
    }
};

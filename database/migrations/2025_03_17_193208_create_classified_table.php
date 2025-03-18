<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classifieds', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('phone');
            $table->string('email');
            $table->string('address');
            $table->decimal('payment');
            $table->text('description');

            $table->unsignedBigInteger('job_offers_id')->nullable();

            $table->foreign('job_offers_id')
            ->references('id')
            ->on('job_offers')
            ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classifieds');
    }
};

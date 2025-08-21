<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Solo agregar columnas si no existen
        if (!Schema::hasColumn('job_applications', 'status')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->string('status', 20)->default('pending')->after('message');
            });
        }
        if (!Schema::hasColumn('job_applications', 'cv_path')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->string('cv_path')->nullable()->after('status');
            });
        }

        // Normalización de estados históricos en español a valores canónicos
        \DB::table('job_applications')->where('status', 'pendiente')->update(['status' => 'pending']);
        \DB::table('job_applications')->whereIn('status', ['aceptada', 'aceptado'])->update(['status' => 'accepted']);
        \DB::table('job_applications')->whereIn('status', ['rechazada', 'rechazado'])->update(['status' => 'rejected']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['status', 'cv_path']);
        });
        // No se revierte la normalización de datos históricos
    }
};

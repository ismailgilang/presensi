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
        Schema::create('data_karyawan', function (Blueprint $table) {
            $table->string('nik');
            $table->string('name');
            $table->string('jabatan');
            $table->string('unit');
            $table->string('status');
            $table->string('bpjskt');
            $table->string('bpjskn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_karyawan');
    }
};

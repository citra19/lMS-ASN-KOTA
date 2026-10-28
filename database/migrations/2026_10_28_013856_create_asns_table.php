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
        Schema::create('asns', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18)->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('opd'); // Perangkat Daerah / Unit Kerja
            $table->string('position'); // Jabatan ASN
            $table->string('rank_group')->nullable(); // Pangkat / Golongan
            $table->string('phone')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asns');
    }
};

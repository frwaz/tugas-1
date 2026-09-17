<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * CATATAN: Project Laravel baru (composer create-project) SUDAH punya
     * migration bawaan untuk tabel users (0001_01_01_000000_create_users_table.php),
     * dan field-nya (name, email, password) sudah sama persis dengan yang
     * dibutuhkan di sini. Jadi:
     *   - Kalau project Laravel-mu masih punya migration bawaan itu, JANGAN
     *     salin file ini — cukup pakai yang sudah ada supaya tidak bentrok
     *     ("table already exists").
     *   - File ini disertakan untuk dokumentasi/kelengkapan tugas, dan hanya
     *     dipakai kalau migration users bawaan sudah dihapus/tidak ada.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

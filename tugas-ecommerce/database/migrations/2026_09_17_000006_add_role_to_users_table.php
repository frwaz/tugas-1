<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom "role" pada tabel users untuk membedakan
     * pengguna biasa ("user") dan admin ("admin").
     *
     * Default-nya "user", jadi akun yang sudah ada / mendaftar lewat
     * form registrasi Breeze otomatis berperan sebagai user biasa.
     * Untuk menjadikan seseorang admin, ubah manual lewat seeder,
     * tinker, atau langsung di database:
     *
     *   php artisan tinker
     *   >>> User::where('email', 'admin@tokokita.test')->update(['role' => 'admin']);
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};

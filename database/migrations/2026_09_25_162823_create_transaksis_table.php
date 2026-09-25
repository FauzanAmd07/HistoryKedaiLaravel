<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->onDelete('cascade');
            $table->foreignId('id_karyawan')->nullable()->constrained('users', 'id_karyawan')->onDelete('set null');
            $table->dateTime('tanggal');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', ['Baru Masuk', 'Sedang Diproses', 'Selesai', 'Batal'])->default('Baru Masuk');
            $table->string('metode_bayar')->default('Tunai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

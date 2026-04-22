<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel header pesanan
        if (!Schema::hasTable('tr_pesanan')) {
            Schema::create('tr_pesanan', function (Blueprint $table) {
                $table->increments('id_pesanan');
                $table->string('nama_customer', 100);
                $table->string('no_wa', 20);
                $table->text('alamat');
                $table->text('catatan')->nullable();
                $table->unsignedBigInteger('total_harga')->default(0);
                $table->date('tanggal_pesan');
                $table->timestamps();
            });
        } else {
            // Pastikan kolom catatan ada (untuk database yang sudah ada)
            if (!Schema::hasColumn('tr_pesanan', 'catatan')) {
                Schema::table('tr_pesanan', function (Blueprint $table) {
                    $table->text('catatan')->nullable()->after('alamat');
                });
            }
        }

        // Tabel detail pesanan
        if (!Schema::hasTable('tr_detailpesanan')) {
            Schema::create('tr_detailpesanan', function (Blueprint $table) {
                $table->increments('id_detail');
                $table->unsignedInteger('id_pesanan');
                $table->unsignedInteger('id_produk');
                $table->integer('qty')->default(1);
                $table->unsignedBigInteger('harga')->default(0);
                $table->unsignedBigInteger('subtotal')->default(0);
                $table->timestamps();

                $table->foreign('id_pesanan')
                      ->references('id_pesanan')
                      ->on('tr_pesanan')
                      ->onDelete('cascade');
            });
        } else {
            // Pastikan kolom subtotal, harga ada
            if (!Schema::hasColumn('tr_detailpesanan', 'subtotal')) {
                Schema::table('tr_detailpesanan', function (Blueprint $table) {
                    $table->unsignedBigInteger('subtotal')->default(0)->after('qty');
                });
            }
            if (!Schema::hasColumn('tr_detailpesanan', 'harga')) {
                Schema::table('tr_detailpesanan', function (Blueprint $table) {
                    $table->unsignedBigInteger('harga')->default(0)->after('qty');
                });
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_detailpesanan');
        Schema::dropIfExists('tr_pesanan');
    }
};

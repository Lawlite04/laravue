<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_petugas')->constrained('petugas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nisn', 10);
            $table->foreign('nisn')->references('nisn')->on('siswas')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_bayar')->nullable();
            $table->string('bulan_dibayar', 100)->nullable();
            $table->string('tahun_dibayar', 10)->nullable();
            // $table->unsignedBigInteger('id_spp');
            // $table->foreign('id_spp')->references('id_spp')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_bayar')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}

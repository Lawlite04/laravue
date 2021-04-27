<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->index();
            $table->string('nis', 8);
            $table->string('nama');
            $table->foreignId('id_kelas')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->text('alamat');
            $table->string('no_telp', 13);
            $table->foreignId('id_spp')->constrained('spps')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('siswas');
    }
}

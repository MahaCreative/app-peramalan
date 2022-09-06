<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->integer('tahun_penjualan');
            $table->integer('jan');
            $table->integer('feb');
            $table->integer('mar');
            $table->integer('apr');
            $table->integer('mei');
            $table->integer('jun');
            $table->integer('jul');
            $table->integer('agu');
            $table->integer('sep');
            $table->integer('oct');
            $table->integer('nov');
            $table->integer('dec');
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
        Schema::dropIfExists('detail_penjualans');
    }
}
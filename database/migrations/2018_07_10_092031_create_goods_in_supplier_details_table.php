<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsInSupplierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_in_supplier_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qyt_box')->nullable();
            $table->integer('qyt_pcs')->nullable();
            $table->string('description')->nullable();
            $table->string('id_goods');
            $table->string('id_goods');
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
        Schema::dropIfExists('goods_in_supplier_details');
    }
}

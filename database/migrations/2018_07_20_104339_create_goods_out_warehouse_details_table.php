<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsOutWarehouseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_out_warehouse_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qyt_box')->nullable();
            $table->integer('qyt_pcs')->nullable();
            $table->string('description')->nullable();
            $table->string('id_goods');
            $table->string('id_goods_out_warehouse');
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
        Schema::dropIfExists('goods_out_warehouse_details');
    }
}

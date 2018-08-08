<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sales_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qyt_box_out')->nullable();
            $table->integer('qyt_pcs_out')->nullable();
            $table->integer('qyt_box_in')->nullable();
            $table->integer('qyt_pcs_in')->nullable();
            $table->integer('bad_stok_box')->nullable();
            $table->integer('bad_stok_pcs')->nullable();
            $table->string('description')->nullable();
            $table->string('id_goods');
            $table->string('id_goods_sales');
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
        Schema::dropIfExists('goods_sales_details');
    }
}

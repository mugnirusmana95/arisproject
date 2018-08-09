<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnWahousesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_wahouses_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qyt_box')->nullable();
            $table->integer('qyt_pcs')->nullable();
            $table->integer('bad_stock_box')->nullable();
            $table->integer('bad_stock_pcs')->nullable();
            $table->string('id_goods');
            $table->string('id_return_warehouse');
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
        Schema::dropIfExists('return_wahouses_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idOrderDetail');
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')->references('idOrder')->constrained('orders')->on('orders')->onUpdate('cascade');
            $table->string('name');
            $table->string('requiredAmount');
            $table->string('deliveryAmount');
            $table->string('missingAmount');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};

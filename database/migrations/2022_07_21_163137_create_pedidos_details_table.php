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
        Schema::create('pedidos_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idPedidoDetails');
            $table->unsignedBigInteger('idPedido');
            $table->foreign('idPedido')->references('idPedido')->constrained('pedidos')->on('pedidos')->onUpdate('cascade');
            $table->string('idProduct');
            $table->string('amountDelivery');
            $table->string('amountRemaining');
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
        Schema::dropIfExists('pedidos_details');
    }
};

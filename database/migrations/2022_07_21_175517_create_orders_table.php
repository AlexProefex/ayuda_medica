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
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idOrder');
            $table->unsignedBigInteger('idLaboratory');
            $table->foreign('idLaboratory')->references('idLaboratory')->constrained('laboratories')->on('laboratories')->onUpdate('cascade');
            $table->string('idUser');
            $table->string('idConsultory');
            $table->string('dateDelivery');
            $table->string('status');
            $table->string('amountReceived');
            $table->string('amountRequired');
            $table->string('idProduct');
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
        Schema::dropIfExists('orders');
    }
};

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
    {
        /*Schema::create('product_consultories', function (Blueprint $table) {
            $table->bigIncrements('idProducConsultory');
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('idProduct')->constrained('product_inventory')->on('products')->onUpdate('cascade');
            $table->unsignedBigInteger('idConsultory');
            $table->foreign('idConsultory')->references('idConsultory')->constrained('consultory_inventory')->on('consultories')->onUpdate('cascade');
            $table->integer('amount');
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
        Schema::dropIfExists('product_consultories');
    }
};

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
        /*Schema::create('kardexes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idKardex');
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('idProduct')->constrained('kardex_inventory')->on('products')->onUpdate('cascade');
            $table->integer('stockCurrent');
            $table->integer('amount');
            $table->integer('stockRemaining');
            $table->string('type');
            $table->integer('idUser');
            $table->integer('idConsultory');
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
        Schema::dropIfExists('kardexes');
    }
};

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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idLaboratory');
            $table->string('business');
            $table->string('name');
            $table->string('orders')->nullable()->default(0);//pendientes
            $table->string('pendientes')->nullable()->default(0);//pendientes
            $table->string('email')->nullable();
            $table->text('laboratory_items')->nullable();
            $table->timestamps();
        });
       */ 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratories');
    }
};

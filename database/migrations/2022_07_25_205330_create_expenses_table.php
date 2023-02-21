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
        Schema::create('expenses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idExpenses');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('idUser')->constrained('user_admins_expenses')->on('user_admins')->onUpdate('cascade');
            $table->string('document');
            $table->string('reason');
            $table->string('observations')->nullable();
            $table->string('amount');
            $table->json('details');
            //$table->int('modifiedBy')->default(1);
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
        Schema::dropIfExists('expenses');
    }
};

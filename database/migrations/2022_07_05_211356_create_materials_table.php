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
        /*Schema::create('materials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idMaterial');
            $table->unsignedBigInteger('idTreatment');
            $table->foreign('idTreatment')->references('idTreatment')->constrained('detail_treatments_materials')->on('treatments')->onUpdate('cascade');
            $table->string('name');
            $table->string('price')->default('0');
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
        Schema::dropIfExists('materials');
    }
};

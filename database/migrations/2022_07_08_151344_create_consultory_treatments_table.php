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
        /*Schema::create('consultory_treatments', function (Blueprint $table) 
        { 
          $table->engine = 'InnoDB';
          $table->bigIncrements('idConsultoryTreatments');
          $table->unsignedBigInteger('idTreatment');
          $table->foreign('idTreatment')->references('idTreatment')->constrained('detail_treatments')->on('treatments')->onUpdate('cascade');
          $table->string('idConsultory'); //Validar dentro de la vista que la variable siempre envie un dato con el siguiente indice "idConsultory para crear la relacion a sus respectivos padres ruta en duda'treatments->store'"
          $table->string('price')->default(0);
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
        Schema::dropIfExists('consultory_treatments');
    }
};

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
        /*Schema::create('consultory_materials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idMaterialConsultory');
            $table->string('idTreatment');
            $table->unsignedBigInteger('idMaterial');
            $table->foreign('idMaterial')->references('idMaterial')->constrained('detail_treatments_material')->on('materials')->onUpdate('cascade');
            $table->string('price')->default(0);
            $table->string('idConsultory');//Validar dentro de la vista que la variable siempre envie un dato con el siguiente indice "idConsultory para crear la relacion a sus respectivos padres Ruta en duda 'treatments->store'"
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
        Schema::dropIfExists('consultory_materials');
    }
};

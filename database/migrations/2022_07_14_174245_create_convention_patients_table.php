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
        /*Schema::create('convention_patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idConventionPatient');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')->references('idPatient')->constrained('convetion_patients')->on('patients')->onUpdate('cascade');
            $table->unsignedBigInteger('idConvention');
            $table->foreign('idConvention')->references('idConvention')->constrained('convention_convetions')->on('conventions')->onUpdate('cascade');
            $table->string('status')->default('Activo');
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
        Schema::dropIfExists('convention_patients');
    }
};

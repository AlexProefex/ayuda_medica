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
        /*Schema::create('odontograms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idOdontogram');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')->references('idPatient')->constrained('patients')->on('patients')->onUpdate('cascade');
            $table->text('dataOdontogram')->nullable();
            $table->text('date');
            $table->string('dateOdontogram')->unique();
            $table->string('status')->default('pendiente');
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
        Schema::dropIfExists('odontograms');
    }
};

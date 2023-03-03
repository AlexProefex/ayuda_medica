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
        Schema::create('appointments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idAppointments');
            $table->bigInteger('idCategory');
            $table->string('location')->nullable();
            $table->unsignedBigInteger('idDoctor');
            $table->foreign('idDoctor')->references('idUser')->constrained('user')->on('user_admins')->onUpdate('cascade');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')->references('idPatient')->constrained('patients')->on('patients')->onUpdate('cascade');
            $table->unsignedBigInteger('idSpecialty');
            $table->foreign('idSpecialty')->references('idSpecialty')->constrained('specialities_appointment')->on('specialties')->onUpdate('cascade');
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->string('observation')->default('--');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};

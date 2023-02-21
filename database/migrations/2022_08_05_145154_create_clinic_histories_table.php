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
        Schema::create('clinic_histories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idClinicHistory');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')->references('idPatient')->constrained('clinic_histories_patients')->on('patients')->onUpdate('cascade');
            $table->unsignedBigInteger('idDoctor');
            $table->foreign('idDoctor')->references('idUser')->constrained('clinic_histories_user_admins')->on('user_admins')->onUpdate('cascade');
            //$table->unsignedBigInteger('idConsultory');
            //$table->foreign('idConsultory')->references('idConsultory')->constrained('clinic_histories_consultories')->on('consultories')->onUpdate('cascade');
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('clinic_histories');
    }
};

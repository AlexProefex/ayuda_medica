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
        Schema::create('speciality_users', function (Blueprint $table) {
            $table->bigIncrements('idSpecialityUser');
            $table->unsignedBigInteger('idSpecialty');
            $table->foreign('idSpecialty')->references('idSpecialty')->constrained('specialties')->on('specialties')->onUpdate('cascade');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('idUser')->constrained('specialties_user_admins')->on('user_admins')->onUpdate('cascade');
            $table->string('status')->default('Activo');
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
        Schema::dropIfExists('speciality_users');
    }
};

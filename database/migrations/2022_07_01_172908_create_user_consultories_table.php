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
        /*Schema::create('user_consultories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idUserConsultory');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('idUser')->constrained('user_admins_consultories')->on('user_admins')->onUpdate('cascade');
            $table->integer('idConsultory');
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
        Schema::dropIfExists('user_consultories');
    }
};

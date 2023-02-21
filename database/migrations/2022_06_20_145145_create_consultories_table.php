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
        /*Schema::create('consultories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idConsultory');
            $table->string('name');
            $table->unsignedBigInteger('idManager');
            $table->foreign('idManager')->references('idUser')->constrained('user_admin_manager')->on('user_admins')->onUpdate('cascade');
            $table->string('start_time');
            $table->string('end_time');
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
        Schema::dropIfExists('consultories');
    }
};

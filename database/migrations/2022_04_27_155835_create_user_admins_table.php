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
        Schema::create('user_admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idUser');
            $table->string('name');
            $table->string('last_name');
            $table->string('document_number')->unique();
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->unsignedBigInteger('idRol');
            $table->foreign('idRol')->references('idRol')->constrained('roles')->on('roles')->onUpdate('cascade');
            $table->string('avatar')->nullable()->default('default-thumbnail.jpg');
            $table->string('state')->default('Activo');
            $table->string('password');
            $table->string('date')->nullable();
            $table->text('schedule')->default('[{day: "",checkInTime: null,departureTime: null,disabled: false}]');
      
            $table->string('location')->nullable();
            $table->string('timezone')->nullable();
            $table->string('observations')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user_admins');
    }
};

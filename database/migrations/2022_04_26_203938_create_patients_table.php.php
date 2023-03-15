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
        
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idPatient');
            $table->string('name')->fulltext();
            $table->string('last_name')->fulltext();
            $table->string('document_type');
            $table->string('document_number')->unique()->fulltext();
            $table->string('phone_number');
            $table->string('email');
            $table->string('avatar')->default('default-thumbnail.jpg');
            $table->string('birthdate');
            $table->text('diseases')->nullable();
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
        Schema::dropIfExists('patients');
    
    }
};

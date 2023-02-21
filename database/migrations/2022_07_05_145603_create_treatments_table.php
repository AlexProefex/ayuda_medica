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
        /*Schema::create('treatments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idTreatment');
            $table->string('name');
            $table->string('price')->default('0');
            $table->string('hasMaterial')->default('no');
            $table->string('isInOdontogram')->default('no');
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
        Schema::dropIfExists('treatments');
    }
};

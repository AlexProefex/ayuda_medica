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
        /*Schema::create('conventions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idConvention');
            $table->string('name');
            $table->string('company_name');
            $table->text('discount');
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
        Schema::dropIfExists('conventions');
    }
};

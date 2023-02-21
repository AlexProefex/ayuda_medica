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
    {/*
        Schema::create('sales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idSale');
            $table->unsignedBigInteger('idDoctor');
            $table->foreign('idDoctor')->references('idUser')->constrained('budgets_user_admins')->on('user_admins')->onUpdate('cascade');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')->references('idPatient')->constrained('clinic_histories_patients')->on('patients')->onUpdate('cascade');
            $table->integer('idConvention');
            $table->unsignedBigInteger('idConsultory');
            $table->foreign('idConsultory')->references('idConsultory')->constrained('budgets_consultories')->on('consultories')->onUpdate('cascade');
            $table->decimal('total',10,2)->default(0);
            $table->string('status')->default('pendiente');
            $table->string('remainingBalance')->default('0');
            $table->mediumText('elements')->nullable();
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
        Schema::dropIfExists('sales');
    }
};

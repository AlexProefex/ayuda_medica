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
        /*Schema::create('budget_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idBudgetDetail');
            $table->unsignedBigInteger('idBudget');
            $table->foreign('idBudget')->references('idBudget')->constrained('budgets')->on('budgets')->onUpdate('cascade');
            $table->unsignedBigInteger('idTreatment');
            $table->foreign('idTreatment')->references('idTreatment')->constrained('treatments')->on('treatments')->onUpdate('cascade');
            $table->integer('idMaterial');
            $table->integer('amount');
            $table->decimal('price',10,2);
            $table->decimal('subTotal',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('total',10,2);
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
        Schema::dropIfExists('budget_details');
    }
};

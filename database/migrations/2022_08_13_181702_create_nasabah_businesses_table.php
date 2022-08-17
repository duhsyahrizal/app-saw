<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabahBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah_businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nasabah_id');
            $table->string('business_name', 200);
            $table->string('business_address', 200);
            $table->integer('operating_revenue');
            $table->integer('business_fund');
            $table->integer('net_income');
            $table->integer('other_income');
            $table->integer('business_expense');
            $table->integer('non_business_expense');
            $table->integer('total_installment');
            $table->integer('recommendation_loan');
            $table->integer('recommendation_installment');
            $table->string('business_photo', 255);
            $table->timestamps();

            $table->foreign('nasabah_id')->references('id')->on('nasabahs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nasabah_businesses');
    }
}

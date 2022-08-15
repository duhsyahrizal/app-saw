<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nasabah_id');
            $table->date('borrow_date')->default(\Carbon\Carbon::now());
            $table->integer('loan_nominal')->nullable();
            $table->integer('remaining_payment')->nullable();
            $table->boolean('is_paid')->default(0);
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
        Schema::dropIfExists('riwayats');
    }
}

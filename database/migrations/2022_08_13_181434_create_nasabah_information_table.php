<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabahInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah_information', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nasabah_id');
            $table->date('birth_date')->nullable();
            $table->string('birth_location', 50)->nullable();
            $table->boolean('gender')->nullable();
            $table->string('address_by_identity', 255)->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('sub_district', 50)->nullable();
            $table->string('ward', 50)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('nickname', 50)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('identity_photo', 255)->nullable();
            $table->string('parent_photo', 255)->nullable();
            $table->string('account_photo', 255)->nullable();
            $table->string('face_photo', 255)->nullable();
            $table->tinyInteger('business_status')->comment('0: owner | 1: own parent | 2: lent')->nullable();
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
        Schema::dropIfExists('nasabah_information');
    }
}

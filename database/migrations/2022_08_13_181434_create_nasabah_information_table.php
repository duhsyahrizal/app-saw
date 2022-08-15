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
            $table->boolean('gender')->nullable()->comment('0: Laki laki | 1: Perempuan');
            $table->string('address_by_identity', 255)->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('sub_district', 100)->nullable();
            $table->string('ward', 50)->nullable();
            $table->boolean('ktp_status')->default(true)->comment('0: Belum dicetak | 1: Seumur hidup');
            $table->string('religion', 50)->nullable();
            $table->string('citizenship', 100)->nullable();
            $table->string('profession', 100)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Belum menikah | 1: Menikah | 2: Bercerai');
            $table->string('postal_code', 10)->nullable();
            $table->string('selfi_photo', 255)->nullable();
            $table->string('ktp_photo', 255)->nullable();
            $table->string('savings_photo', 255)->nullable();
            $table->string('face_with_ktp_photo', 255)->nullable();
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

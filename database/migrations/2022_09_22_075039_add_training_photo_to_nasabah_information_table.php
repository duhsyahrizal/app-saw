<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrainingPhotoToNasabahInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nasabah_information', function (Blueprint $table) {
            $table->string('training_photo', 255)->after('face_with_ktp_photo')->nullable();
            $table->boolean('is_trained', 0)->default(0)->after('training_photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nasabah_information', function (Blueprint $table) {
            //
        });
    }
}

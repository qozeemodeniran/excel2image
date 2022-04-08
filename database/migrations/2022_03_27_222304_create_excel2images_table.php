<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcel2imagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel2images', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->text('customer_address');
            $table->string('address_verification_status');
            $table->string('house_picture');
            $table->string('gps');
            $table->string('gps_latitude');
            $table->string('gps_longitude');
            $table->string('gps_altitude');
            $table->string('gps_precision');
            $table->text('landmark_description');
            $table->text('comment');
            $table->string('contact_person');
            $table->string('verification_officer_name');
            $table->string('verification_date');
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
        Schema::dropIfExists('excel2images');
    }
}

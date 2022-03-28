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
            $table->string('customer_name')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('address_verification_status')->nullable();
            $table->string('house_picture')->nullable();
            $table->string('gps')->nullable();
            $table->string('gps_latitude')->nullable();
            $table->string('gps_longitude')->nullable();
            $table->string('gps_altitude')->nullable();
            $table->string('gps_precision')->nullable();
            $table->text('landmark_description')->nullable();
            $table->text('comment')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('verification_officer_name')->nullable();
            $table->string('verification_date')->nullable();
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

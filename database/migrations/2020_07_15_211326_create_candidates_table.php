<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variety_id');
            $table->bigInteger('price');
            $table->bigInteger('age');
            $table->string('gender');
            $table->string('personality');
            $table->string('personality_details',1500);
            $table->string('inspection');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('place_details_id');
            $table->string('place_name');
            $table->string('place_address');
            $table->string('place_phonenumber');
            $table->string('bussinesshours');
            $table->string('coupon',1500)->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            
            $table->foreign('variety_id')->references('id')->on('varieties')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('place_details_id')->references('id')->on('place_details')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}

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
            $table->string('birthday');
            $table->string('gender');
            $table->string('coat_color');
            $table->string('personality');
            $table->string('personality_details',1500);
            $table->string('inspection');
            $table->string('place_name');
            $table->string('place_address');
            $table->string('map',450);
            $table->string('place_phonenumber');
            $table->string('bussinesshours');
            $table->string('URL');
            $table->string('coupon',1500)->nullable();
            $table->bigInteger('view_count')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            
            $table->foreign('variety_id')->references('id')->on('varieties')->onDelete('cascade');
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

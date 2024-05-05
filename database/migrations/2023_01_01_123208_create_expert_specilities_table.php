<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertSpecilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_speciality', function (Blueprint $table) {
            $table->id();
            //$table->integer('expert_id');
           // $table->integer('speciality_id');
            $table->foreignId('speciality_id')->references('id')->on('specialities')->onDelete('cascade');
            $table->foreignId('expert_id')->references('id')->on('experts')->onDelete('cascade');
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
        Schema::dropIfExists('expert_specilities');
    }
}

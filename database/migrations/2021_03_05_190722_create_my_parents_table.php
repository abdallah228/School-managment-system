<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('paassword');
            //father information
            $table->string('father_name');
            $table->string('father_national_id');
            $table->string('father_passport_id');
            $table->string('father_phone');
            $table->string('father_job');
            $table->string('father_address');
            $table->integer('nationality_father_id')->unsigned()->unique();
            $table->integer('blood_type_father_id')->unsigned()->unique();
            $table->integer('religion_father_id')->unsigned()->unique();

            //mother informaton
            $table->string('mother_name');
            $table->string('mother_national_id');
            $table->string('mother_passport_id');
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->string('mother_address');
            $table->integer('nationality_mother_id')->unsigned()->unique();
            $table->integer('blood_type_mother_id')->unsigned()->unique();
            $table->integer('religion_mother_id')->unsigned()->unique();
            $table->timestamps();

            //foreign key && relations
            //...father foreign key
            $table->foreign('nationality_father_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('blood_type_father_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->foreign('religion_father_id')->references('id')->on('religions')->onDelete('cascade');
            //...mother foreign key
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('blood_type_mother_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->foreign('religion_mother_id')->references('id')->on('religions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my__parents');
    }
}

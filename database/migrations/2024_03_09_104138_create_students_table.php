<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname_fr');
            $table->string('firstname_ar');

            $table->string('lastname_fr');
            $table->string('lastname_ar');

            $table->integer('status')->default(1);
            $table->string('photo')->nullable();

            $table->integer('gender');
            $table->date('birthday');
            $table->string('state_of_birth');            
            $table->string('place_of_birth');
            $table->string('residence');


            $table->string('registration_number')->unique();
            $table->string('group');
            $table->string('batch');
            $table->date('start_date');
            $table->date('end_date');

            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->decimal('moyenFinal');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('admins')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};

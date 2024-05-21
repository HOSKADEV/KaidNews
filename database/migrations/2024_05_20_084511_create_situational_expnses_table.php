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
        Schema::create('situational_expnses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('types_of_expenses_id');
            $table->foreign('types_of_expenses_id')->references('id')->on('types_of_expenses')->onDelete('cascade');
            $table->double('amount', 15, 8);
            $table->date('month')->format('m');
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
        Schema::dropIfExists('situational_expnses');
    }
};

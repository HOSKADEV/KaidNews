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
        Schema::create('direction_cameras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');
            $table->foreign('evaluation_id')->references('id')->on('evaluations');

            $table->smallInteger('content')->default(0);
            $table->smallInteger('vocal_performance')->default(0);
            $table->smallInteger('attendance')->default(0);
            $table->smallInteger('participation_effectiveness')->default(0);

            $table->smallInteger('overall_assessment')->default(0);
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
        Schema::dropIfExists('direction_cameras');
    }
};

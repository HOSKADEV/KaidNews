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
        Schema::create('tv_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');
            $table->foreign('evaluation_id')->references('id')->on('evaluations');

            $table->smallInteger('attractiveness_initiation')->default(0);
            $table->smallInteger('respect_duration')->default(0);
            $table->smallInteger('language_integrity')->default(0);
            $table->smallInteger('interviews')->default(0);
            $table->smallInteger('vocal_performance')->default(0);
            $table->smallInteger('use_scenes')->default(0);
            $table->smallInteger('spontaneous_scene')->default(0);
            $table->smallInteger('content')->default(0);
            $table->smallInteger('conclusion')->default(0);
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
        Schema::dropIfExists('tv_reports');
    }
};

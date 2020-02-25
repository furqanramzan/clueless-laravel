<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->longText('company_url');
            $table->string('room_name');
            $table->longText('room_overview');
            $table->longText('body');
            $table->string('country');
            $table->string('region');
            $table->integer('puzzles_gameplay');
            $table->integer('design_and_theming');
            $table->integer('games_mastery');
            $table->integer('innovation_tech');
            $table->integer('overall');
            $table->integer('difficulty');
            $table->string('time');
            $table->string('length');
            $table->string('accessibility');
            $table->string('value');
            $table->string('ideal_for');
            $table->boolean('good_for_kids');
            $table->boolean('good_for_enthusiasts');
            $table->boolean('good_for_design');
            $table->boolean('good_for_technology');
            $table->string('image');
            $table->bigInteger('visits')->default(0);
            $table->boolean('published')->default(0);
            $table->timestamp('published_date')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}

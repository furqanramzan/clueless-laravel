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
            $table->string('puzzles_gameplay');
            $table->string('design_and_theming');
            $table->string('games_mastery');
            $table->string('innovation_tech');
            $table->string('overall');
            $table->string('time');
            $table->string('length');
            $table->string('accessibility')->nullable();
            $table->string('value');
            $table->string('ideal_for');
            $table->boolean('good_for_kids');
            $table->boolean('good_for_enthusiasts');
            $table->boolean('good_for_design');
            $table->boolean('good_for_technology');
            $table->boolean('jump_scares');
            $table->boolean('wheelchair');
            $table->boolean('is_closed');
            $table->bigInteger('average_price');
            $table->bigInteger('minimum_players');
            $table->bigInteger('maximum_players');
            $table->string('image');
            $table->string('detail_image')->nullable();
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

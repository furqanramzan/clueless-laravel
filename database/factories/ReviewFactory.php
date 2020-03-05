<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        "company_name" => $faker->name,
        "company_url" => $faker->domainName,
        "room_name" => $faker->name,
        "room_overview" => $faker->text($maxNbChars = 250),
        "body" => $faker->phoneNumber,
        "country" => $faker->country,
        "region" => $faker->city,
        "puzzles_gameplay" => $faker->numberBetween(0, 10),
        "design_and_theming" => $faker->numberBetween(0, 10),
        "games_mastery" => $faker->numberBetween(0, 10),
        "innovation_tech" => $faker->numberBetween(0, 10),
        "overall" => $faker->numberBetween(0, 10),
        "time" => '34:34  (60 min room)',
        "length" => $faker->text($maxNbChars = 50),
        "accessibility" => $faker->text($maxNbChars = 50),
        "value" => $faker->text($maxNbChars = 50),
        "ideal_for" => $faker->text($maxNbChars = 50),
        "jump_scares" => $faker->boolean,
        "wheelchair" => $faker->boolean,
        "is_closed" => $faker->boolean,
        "good_for_kids" => $faker->boolean,
        "good_for_enthusiasts" => $faker->boolean,
        "good_for_design" => $faker->boolean,
        "good_for_technology" => $faker->boolean,
        "average_price" => $faker->numberBetween(1, 1000),
        "maximum_players" => $faker->numberBetween(1, 1000),
        "minimum_players" => $faker->numberBetween(1, 1000),
        'image' => 'uploads/reviews/XkVKEzNZ8z5f8Q1jdBIhyRtwBbWmLGsBrYrrx8dn.png',
        'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'published' => 1
    ];
});

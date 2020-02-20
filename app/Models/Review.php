<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'company_url', 'room_name', 'room_overview', 'country', 'region', 'puzzles_gameplay', 'design_and_theming', 'games_mastery', 'innovation_tech', 'overall', 'difficulty', 'time', 'length', 'accessibility', 'value', 'ideal_for', 'good_for_kids', 'good_for_enthusiasts', 'good_for_design', 'good_for_technology', 'image', 'visits', 'published', 'published_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_date' => 'datetime',
    ];
}

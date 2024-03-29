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
        'slug', 'company_name', 'company_url', 'room_name', 'room_overview', 'body', 'country', 'region', 'puzzles_gameplay', 'design_and_theming', 'games_mastery', 'innovation_tech', 'overall', 'time', 'length', 'accessibility', 'value', 'ideal_for', 'good_for_kids', 'good_for_enthusiasts', 'good_for_design', 'good_for_technology', 'image', 'detail_image', 'visits', 'published', 'published_date', 'jump_scares', 'wheelchair', 'is_closed', 'average_price', 'minimum_players', 'maximum_players'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_date' => 'datetime',
    ];

    public function topListReview()
    {
        return $this->hasMany(TopListReview::class);
    }

    public function reviewComments()
    {
        return $this->hasMany(ReviewComment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($obj){
            $obj->topListReview()->delete();
            $obj->reviewComments()->delete();
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}

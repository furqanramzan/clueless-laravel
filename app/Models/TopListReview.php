<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopListReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'top_list_id', 'review_id', 'overview', 'order'
    ];

    public function topList()
    {
        return $this->belongsTo(TopList::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}

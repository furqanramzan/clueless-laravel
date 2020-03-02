<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review_id', 'name', 'body'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}

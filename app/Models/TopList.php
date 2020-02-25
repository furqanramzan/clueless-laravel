<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'introduction', 'order'
    ];

    public function topListReview()
    {
        return $this->hasMany(TopListReview::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($obj){
            $obj->topListReview()->delete();
        });
    }
}

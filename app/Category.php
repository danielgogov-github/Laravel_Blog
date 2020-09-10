<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /**
     * 
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }
}

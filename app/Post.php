<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\Comment;

class Post extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
        'published'
    ];

    /**
     * 
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * 
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }    
}

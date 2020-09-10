<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Comment extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
        'name',
        'email',
        'post_id'
    ];    

    /**
     * 
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }
}

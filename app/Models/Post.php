<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'tag_id',
        'image_url',
        'edited_at',
        ];
    
    function getPaginateByLimit(int $limit_count = 1000)
    {
        return $this::with('tags')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);  
    }
    
    public function histories()
    {
        return $this->hasMany(History::class);  
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);  
    }
    
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function commentCount()
    {
        return $this->comments()->count();
    }

}

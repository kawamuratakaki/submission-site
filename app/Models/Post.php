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
        ];
    
    function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('tags')->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
}

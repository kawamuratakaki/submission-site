<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'post_id',
        'tag_id',
        'image_url',
        ];

public function post()   
{
    return $this->belongsTo(Post::class);  
}
public function user()   
{
    return $this->belongsTo(User::class);  
}
public function category()   
{
    return $this->hasOne(Category::class);  
}
}
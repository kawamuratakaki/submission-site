<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',  // 他にあればその属性も追加
        'post_id',  // 追加
    ];
    
    public function post()   
    {
        return $this->belongsTo(Post::class);  
    }
    public function user()   
    {
        return $this->belongsTo(User::class);  
    }
}

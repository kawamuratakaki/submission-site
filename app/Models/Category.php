<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['like_id', 'read'];
    
    public function like()
    {
        return $this->belongsTo(Like::class);
    }
}

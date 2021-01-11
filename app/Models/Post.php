<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'content',
        'title'
        
    ];

    public function category() {
        return $this->belongsTo(Category::class,'category_id');//PostはCategoryに属する
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');//PostはUserに属する
    }
}

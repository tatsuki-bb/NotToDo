<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_chats extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id');
    }
}

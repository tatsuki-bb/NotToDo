<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_check extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_id',
        'check'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function message()
    {
        return $this->belongsTo(Group_chats::class,'message_id');
    }
}

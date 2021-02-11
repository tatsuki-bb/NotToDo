<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class CheckMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_id',
        'check',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function message()
    {
        return $this->belongsTo(Message::class,'message_id');
    }

    public $timestamps = false;
}

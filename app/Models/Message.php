<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Mainlist;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_id',
        'get_id',
        'mainlist_id',
        'message',
        'chat_id',
        'check'
        
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class,'send_id');
    }

    public function mainlists()
    {
        return $this->belongsTo(Mainlist::class,'mainlist_id');
    }

    
}

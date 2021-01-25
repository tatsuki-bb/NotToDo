<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'user_id',
        'follow_id'
    ];


    protected $fillable = [
        'user_id',
        'follow_id'
        
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}

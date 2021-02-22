<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliation_group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodname',
        'user_id',
        'filename',
        'content',
        'calorie',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_favorites()
    {
        return $this->belongsToMany(User::class,'users','user_id','post_id');
    }
}

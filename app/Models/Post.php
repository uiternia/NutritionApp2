<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Favorite;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodname',
        'user_id',
        'filename',
        'content',
        'calorie',
        'carbon',
        'protein',
        'fat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'favorites');
    }
}

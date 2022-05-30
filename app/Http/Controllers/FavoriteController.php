<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Favorite;
use App\Models\User;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $favorites = $user->favorites;
        
        return Inertia::render('Post/Favorite',
        [
            'favorites' => $favorites,
        ]);
    }

    public function store(Post $post)
    {
        $favorite = New Favorite();
        $favorite->post_id = $post->id;
        $favorite->user_id = Auth::id();
        $favorite->save();
        return back();
    }

    public function delete(Post $post)
    {
        $user = Auth::id();
        $favorite = Favorite::where('post_id',$post->id)->where('user_id',$user)->first();
        $favorite->delete();
        return back();
    }
}

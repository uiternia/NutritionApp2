<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Favorite;
use App\Models\Nutrition;
use App\Models\User;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $posts = $user->favorites()->paginate(12);
        
        return Inertia::render('Post/Favorite',
        [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function add(Post $post) 
    {
        $user = Auth::id();
        Nutrition::create([
            'user_id' => $user,
            'type_id' => $post->type_id,
            'cooking' => $post->foodname,
            'mycalorie' => $post->calorie,
            'myfat' => $post->fat,
            'mycarbon' => $post->carbon,
            'myprotein' => $post->protein,
        ]);
        $nutritions = Nutrition::where('user_id', $user)->get();
        return Inertia::render('Nutrition/Index',['nutritions' => $nutritions]);
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

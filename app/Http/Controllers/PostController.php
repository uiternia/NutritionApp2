<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Favorite;
use Inertia\Inertia;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function mypost()
    {
        $user = Auth::id();
        $posts = Post::where('user_id',$user)->get();
        return Inertia::render('Post/MyPost',
        [
            'posts' => $posts,
        ]);
    }
    
    public function index()
    {
        $posts = DB::table('posts')->get();
        return Inertia::render('Post/Index',
        [
            'posts' => $posts,
        ]
    );
    }

   
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(StorePostRequest $request)
    {
        $user = Auth::id();
        $image = $request->file;

        if(!is_null($image) && $image->isValid())
        {
            $fileNameToStore = ImageService::upload($image);
        }
        Post::create([
            'user_id' => $user,
            'foodname' => $request->foodname,
            'content' => $request->postText,
            'calorie' => $request->calorie,
            'filename' => $fileNameToStore,
        ]);
        return redirect()->route('posts.index');
    }

    
    public function show(Post $post)
    {
        $user = Auth::id();
        $postUser = $post->user;
        $favorite = Favorite::where('post_id',$post->id)->where('user_id',$user)->first();
        $favoriteCount = Favorite::where('post_id',$post->id)->get();
        return Inertia::render('Post/Show',['post' => $post , 'user' => $postUser, 'favorite' => $favorite , 'favoriteCount' => $favoriteCount]);
    }

    
    public function edit(Post $post)
    {
        
    }

    
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

   
    public function destroy(Post $post)
    {
        $file = $post->filename;
        $file = str_replace('/storage/', '', $file);
        $filePath = 'public/' . $file;
        Storage::delete($filePath);
        $post->delete();
        return redirect()->route('posts.index');
    }
}

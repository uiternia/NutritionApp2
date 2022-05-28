<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Inertia\Inertia;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->get();
        return Inertia::render('Post/Index',
        [
            'posts' => $posts,
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $user = Auth::id();
        $image = $request->file;

        // $image_name = $request->file->getClientOriginalName();
        // $request->file->storeAs('public/',$image_name);

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
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = Auth::id();
        return Inertia::render('Post/Show',['post' => $post , 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $file = $post->filename;
        $file = str_replace('/storage/', '', $file);
        $filePath = 'public/' . $file;
        Storage::delete($filePath);
        $post->delete();
        return redirect()->route('post.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($posts);
        $posts->load(['createdBy','image','categories','tags','comments','likes']);


        $posts = PostResource::collection($posts);
        return $this->sendSuccess(data: $posts, metadata: $metaData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        // dd($request->all());
        return $this->sendSuccess($post, 'post created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Increment the post views
        $postViews = $post->views + 1;
        $post->update(['views' => $postViews]);

        $post->load(['createdBy','image','categories','tags','comments','likes']);

        $post = new PostResource($post);
        return $this->sendSuccess($post, 'post fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user = request()->user();

        if($user->roleHas('editor') || $post->user_id == $user->id){
            $post->update($request->all());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $post = new PostResource($post);
        return $this->sendSuccess($post, 'post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $post->user_id == $user->id){
            $post->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'post deleted successfully');

    }


    protected function uploadImage(){

    }
}

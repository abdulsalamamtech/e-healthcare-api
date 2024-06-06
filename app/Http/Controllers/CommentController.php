<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::paginate();
        $comment->load(['subComments', 'subComments.subComments', 'subComments.subComments.subComments']);

        $comment = CommentResource::collection($comment);
        return $this->sendSuccess($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $comment = new Comment();
        $comment->user_id = $data['user_id'];
        $comment->post_id = $data['post_id'];
        $comment->parent_comment_id = $data['parent_comment_id'] ?? null;
        $comment->content = $data['content'];
        $comment->save();

        $comment = new CommentResource($comment);
        return $this->sendSuccess($comment);

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['subComments', 'subComments.subComments', 'subComments.subComments.subComments']);
        $comment = new CommentResource($comment);

        return $this->sendSuccess($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        $comment = new CommentResource($comment);

        return $this->sendSuccess($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $comment->user_id == $user->id){
            $comment->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'comment deleted successfully');

    }
}

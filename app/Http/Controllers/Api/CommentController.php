<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Comments\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;

        $comment = $this->commentService->store($data);

        return new CommentResource($comment->load('user', 'replies'));
    }
    public function index(Post $post)
    {
        $comments = $this->commentService->getCommentsWithReplies($post);
        return CommentResource::collection($comments);
    }
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $updated = $this->commentService->update($comment, $request->validated());
        return new CommentResource($updated);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->commentService->delete($comment);
        return response()->json(['message' => 'Comment deleted successfully.'], 200);
    }
}

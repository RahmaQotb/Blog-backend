<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function store(array $data)
    {
        return Comment::create($data);
    }

    public function getCommentsWithReplies($post)
    {
        return $post->comments()->with('replies')->get();
    }
    public function update($comment, array $data)
    {
        $comment->update($data);
        return $comment;
    }

    public function delete($comment)
    {
        return $comment->delete();
    }
}

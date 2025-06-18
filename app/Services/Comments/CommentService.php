<?php

namespace App\Services\Comments;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(array $data)
    {
        return $this->commentRepository->store($data);
    }

    public function update($comment, array $data)
    {
        return $this->commentRepository->update($comment, $data);
    }

    public function delete($comment)
    {
        return $this->commentRepository->delete($comment);
    }
    public function getCommentsWithReplies($post)
    {
        return $this->commentRepository->getCommentsWithReplies($post);
    }
}

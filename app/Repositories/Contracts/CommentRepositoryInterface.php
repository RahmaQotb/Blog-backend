<?php
// 📁 app/Repositories/Contracts/CommentRepositoryInterface.php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface CommentRepositoryInterface
{
    public function store(array $data);
    public function getCommentsWithReplies(Post $post);
    public function update($comment, array $data);
    public function delete($comment);

}

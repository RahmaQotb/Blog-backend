<?php

namespace App\Services\Posts;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Http\Request;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepository) {}

    public function store(array $data, $images = [])
    {
        return $this->postRepository->store($data, $images);
    }

    public function update($post, array $data, $images = [])
    {
        return $this->postRepository->update($post, $data, $images);
    }

    public function delete($post)
    {
        return $this->postRepository->delete($post);
    }
      public function show($post)
    {
        return $this->postRepository->show($post);
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function store(array $data, $images)
    {
        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        $this->handleImages($post, $images);

        return $post;
    }

    public function update($post, array $data, $images)
    {
        $post->update($data);

        if ($images) {
            $this->handleImages($post, $images);
        }

        return $post;
    }

    public function delete($post)
    {
        $post->clearMediaCollection('images');

        return $post->delete();
    }

    protected function handleImages($post, $images)
    {
        foreach ($images as $image) {
            if ($image && $image->isValid()) {
                $post->addMedia($image)->toMediaCollection('images');
            }
        }
    }
 
    public function show($post)
    {
        return $post;
    }
}

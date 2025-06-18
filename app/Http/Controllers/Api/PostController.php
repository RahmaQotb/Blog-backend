<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Posts\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected PostService $postService) {}

    public function index()
    {
        return PostResource::collection(Post::latest()->paginate());
    }

    public function store(StorePostRequest $request): PostResource
    {

        $post = $this->postService->store($request->validated(), $request->file('images', []));
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $updated = $this->postService->update($post, $request->validated(), $request->file('images'));
        return new PostResource($updated);
    }

    public function destroy(Post $post) : JsonResponse
    {
        $this->postService->delete($post);
        return response()->json(['message' => 'Post deleted']);
    }
    public function show(Post $post): JsonResponse
    {
        $post = $this->postService->show($post);

        return response()->json([
            'message' => 'Post retrieved successfully',
            'data' => new PostResource($post)
        ]);
    }
     
}

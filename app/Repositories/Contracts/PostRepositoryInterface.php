<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function store(array $data, $images);
    public function update($post, array $data, $images);
    public function delete($post);
    public function show($post);
}

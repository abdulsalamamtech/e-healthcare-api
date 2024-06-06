<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($tags);
        $tags->load(['createdBy']);

        $tags = TagResource::collection($tags);
        return $this->sendSuccess($tags, metadata: $metaData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->all());
        $tag = new TagResource($tag);
        return $this->sendSuccess($tag, 'post created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag = new TagResource($tag);
        return $this->sendSuccess($tag, );;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
        $tag = new TagResource($tag);

        return $this->sendSuccess($tag, 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->sendSuccess([], 'tag deleted successfully');

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::paginate();
        $metaData = $this->getMetadata($subscribers);
        $subscribers = SubscriberResource::collection($subscribers);

        return $this->sendSuccess(data: $subscribers, metadata: $metaData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->all());
        $subscriber = new SubscriberResource($subscriber);

        return $this->sendSuccess($subscriber, 'subscriber created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        $subscriber = new SubscriberResource($subscriber);
        return $this->sendSuccess($subscriber, 'subscriber fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->all());

        $subscriber = new SubscriberResource($subscriber);
        return $this->sendSuccess($subscriber, 'subscriber updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return $this->sendSuccess([], 'subscriber deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Http\Resources\DonationResource;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donation = Donation::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($donation);
        $donation->load($this->relationships());


        $data = DonationResource::collection($donation);
        return $this->sendSuccess(data: $data, metadata: $metaData);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id ?? null;

        $data = Donation::create($validatedData);
        return $this->sendSuccess($data, 'donation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        $donation->load($this->relationships());

        $data = new DonationResource($donation);
        return $this->sendSuccess($data, 'donation fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonationRequest $request, Donation $donation)
    {
        $donation->update($request->validated());

        $data = new DonationResource($donation);
        return $this->sendSuccess($data, 'donation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        return $this->sendSuccess([], 'donation can not be deleted');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user'];
    }
}

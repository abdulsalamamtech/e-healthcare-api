<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Http\Resources\PharmacyResource;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies = Pharmacy::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($pharmacies);
        $pharmacies->load($this->relationships());


        $data = PharmacyResource::collection($pharmacies);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {
        $data = Pharmacy::create($request->validated());
        return $this->sendSuccess($data, 'doctor created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        $pharmacy->load($this->relationships());

        $data = new PharmacyResource($pharmacy);
        return $this->sendSuccess($data, 'pharmacy fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->validated());
        $data = new PharmacyResource($pharmacy);
        return $this->sendSuccess($data, 'pharmacy updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $pharmacy->user_id == $user->id){
            $pharmacy->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'pharmacy deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user','drugs'];
    }
}

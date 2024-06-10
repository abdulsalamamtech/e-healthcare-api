<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Http\Resources\HospitalResource;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($hospitals);
        $hospitals->load($this->relationships());


        $data = HospitalResource::collection($hospitals);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalRequest $request)
    {
        $data = Hospital::create($request->validated());
        return $this->sendSuccess($data, 'hospital created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        $hospital->load($this->relationships());

        $data = new HospitalResource($hospital);
        return $this->sendSuccess($data, 'hospital fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $user = request()->user();

        if($user->roleHas('doctors') || $hospital->user_id == $user->id){
            $hospital->update($request->validated());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $data = new HospitalResource($hospital);
        return $this->sendSuccess($data, 'hospital updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $hospital->user_id == $user->id){
            $hospital->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'hospital deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user','patients', 'treatments','prescriptions','emergencies', 'labTests'];
    }
}

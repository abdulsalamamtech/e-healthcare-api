<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Http\Resources\EmergencyResource;
use App\Http\Requests\StoreEmergencyRequest;
use App\Http\Requests\UpdateEmergencyRequest;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emergencies = Emergency::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($emergencies);
        $emergencies->load($this->relationships());


        $data = EmergencyResource::collection($emergencies);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmergencyRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id ?? null;
        $validatedData['emergency_no'] = strtoupper(uniqid('EHC-'));

        // return $validatedData;
        $data = Emergency::create($validatedData);
        return $this->sendSuccess($data, 'emergency created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Emergency $emergency)
    {
        $emergency->load($this->relationships());

        $data = new EmergencyResource($emergency);
        return $this->sendSuccess($data, 'drug fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmergencyRequest $request, Emergency $emergency)
    {
        $emergency->update($request->validated());
        $data = new EmergencyResource($emergency);
        return $this->sendSuccess($data, 'emergency updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emergency $emergency)
    {
        $user = request()->user();

        if($user->roleHas('medical-officers') || $emergency->user_id == $user->id){
            $emergency->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'emergency deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user','patient', 'doctor', 'guidanceUser','hospital','medicalOfficer'];
    }
}

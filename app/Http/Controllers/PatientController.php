<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patient = Patient::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($patient);
        $patient->load($this->relationships());


        $data = PatientResource::collection($patient);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $data = Patient::create($request->validated());
        return $this->sendSuccess($data, 'patient created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {

        $patient->load($this->relationships());

        $data = new PatientResource($patient);
        return $this->sendSuccess($data, 'Patient fetched successfully');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $user = request()->user();

        if($user->roleHas('medical-doctors') || $patient->user_id == $user->id){
            $patient->update($request->validated());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $data = new PatientResource($patient);
        return $this->sendSuccess($data, 'patient updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $patient->user_id == $user->id){
            $patient->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'patient deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user','emergency', 'appointments','treatments','prescriptions','emergencies'];
    }
}

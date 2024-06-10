<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionResource;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Prescriptions = Prescription::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($Prescriptions);
        $Prescriptions->load($this->relationships());


        $data = PrescriptionResource::collection($Prescriptions);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrescriptionRequest $request)
    {
        $data = Prescription::create($request->validated());
        return $this->sendSuccess($data, 'prescription created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $Prescription)
    {
        $Prescription->load($this->relationships());

        $data = new PrescriptionResource($Prescription);
        return $this->sendSuccess($data, 'prescription fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrescriptionRequest $request, Prescription $Prescription)
    {
        $Prescription->update($request->validated());
        $data = new PrescriptionResource($Prescription);
        return $this->sendSuccess($data, 'prescription updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $Prescription)
    {
        $user = request()->user();

        if($user->roleHas('pharmacies') || $Prescription->user_id == $user->id){
            $Prescription->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'prescription deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['patient', 'drugs','medicalOfficer', 'doctor', 'hospital', 'emergency'];
    }
}

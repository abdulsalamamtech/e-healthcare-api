<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Http\Controllers\Controller;
use App\Http\Resources\TreatmentResource;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Treatments = Treatment::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($Treatments);
        $Treatments->load($this->relationships());


        $data = TreatmentResource::collection($Treatments);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
        $data = Treatment::create($request->validated());
        return $this->sendSuccess($data, 'Treatment created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $Treatment)
    {
        $Treatment->load($this->relationships());

        $data = new TreatmentResource($Treatment);
        return $this->sendSuccess($data, 'Treatment fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatmentRequest $request, Treatment $Treatment)
    {
        $Treatment->update($request->validated());
        $data = new TreatmentResource($Treatment);
        return $this->sendSuccess($data, 'Treatment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $Treatment)
    {
        $user = request()->user();

        if($user->roleHas('pharmacies') || $Treatment->user_id == $user->id){
            $Treatment->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'Treatment deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['patient', 'doctor','medicalOfficer', 'hospital', 'emergency'];
    }
}

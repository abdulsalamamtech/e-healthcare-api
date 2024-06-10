<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalOfficerRequest;
use App\Http\Requests\UpdateMedicalOfficerRequest;
use App\Http\Resources\MedicalOfficerResource;
use App\Models\MedicalOfficer;

class MedicalOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $MedicalOfficers = MedicalOfficer::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($MedicalOfficers);
        $MedicalOfficers->load($this->relationships());


        $data = MedicalOfficerResource::collection($MedicalOfficers);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicalOfficerRequest $request)
    {
        $data = MedicalOfficer::create($request->validated());
        return $this->sendSuccess($data, 'medical officer created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalOfficer $MedicalOfficer)
    {
        $MedicalOfficer->load($this->relationships());

        $data = new MedicalOfficerResource($MedicalOfficer);
        return $this->sendSuccess($data, 'medical officer fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalOfficerRequest $request, MedicalOfficer $MedicalOfficer)
    {
        $MedicalOfficer->update($request->validated());
        $data = new MedicalOfficerResource($MedicalOfficer);
        return $this->sendSuccess($data, 'medical officer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalOfficer $MedicalOfficer)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $MedicalOfficer->user_id == $user->id){
            $MedicalOfficer->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'medical officer deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user', 'patient', 'emergencies', 'appointments','treatments','prescriptions','emergencies'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DrugPrescription;
use App\Http\Resources\DrugPrescriptionResource;
use App\Http\Requests\StoreDrugPrescriptionRequest;
use App\Http\Requests\UpdateDrugPrescriptionRequest;

class DrugPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DrugPrescription = DrugPrescription::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($DrugPrescription);
        $DrugPrescription->load($this->relationships());


        $data = DrugPrescriptionResource::collection($DrugPrescription);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrugPrescriptionRequest $request)
    {
        $data = DrugPrescription::create($request->validated());
        return $this->sendSuccess($data, 'drug prescription created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DrugPrescription $drugPrescription)
    {

        $drugPrescription->load($this->relationships());

        $data = new DrugPrescriptionResource($drugPrescription);
        return $this->sendSuccess($data, 'drug prescription fetched successfully');

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrugPrescriptionRequest $request, DrugPrescription $drugPrescription)
    {
        $drugPrescription->update($request->validated());
        $data = new DrugPrescriptionResource($drugPrescription);
        return $this->sendSuccess($data, 'drug prescription updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrugPrescription $drugPrescription)
    {
        $user = request()->user();

        if($user->roleHas('pharmacies') || $drugPrescription->user_id == $user->id){
            $drugPrescription->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'drug prescription deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return;
    }
}

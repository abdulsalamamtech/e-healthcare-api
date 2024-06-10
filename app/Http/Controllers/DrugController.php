<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Http\Controllers\Controller;
use App\Http\Resources\DrugResource;
use App\Http\Requests\StoreDrugRequest;
use App\Http\Requests\UpdateDrugRequest;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($drugs);
        $drugs->load($this->relationships());


        $data = DrugResource::collection($drugs);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrugRequest $request)
    {
        $data = Drug::create($request->validated());
        return $this->sendSuccess($data, 'drug created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Drug $drug)
    {
        $drug->load($this->relationships());

        $data = new DrugResource($drug);
        return $this->sendSuccess($data, 'drug fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrugRequest $request, Drug $drug)
    {
        $drug->update($request->validated());
        $data = new DrugResource($drug);
        return $this->sendSuccess($data, 'drug updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drug $drug)
    {
        $user = request()->user();

        if($user->roleHas('pharmacies') || $drug->user_id == $user->id){
            $drug->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'drug deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user','prescriptions'];
    }
}

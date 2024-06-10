<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Http\Resources\LabTestResource;
use App\Http\Requests\StoreLabTestRequest;
use App\Http\Requests\UpdateLabTestRequest;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $LabTests = LabTest::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($LabTests);
        $LabTests->load($this->relationships());


        $data = LabTestResource::collection($LabTests);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabTestRequest $request)
    {
        $data = LabTest::create($request->validated());
        return $this->sendSuccess($data, 'lab test created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(LabTest $labTest)
    {
        $labTest->load($this->relationships());

        $data = new LabTestResource($labTest);
        return $this->sendSuccess($data, 'lab test fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabTestRequest $request, LabTest $labTest)
    {
        $user = request()->user();

        if($user->roleHas('doctors') || $labTest->user_id == $user->id){
            $labTest->update($request->validated());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $data = new LabTestResource($labTest);
        return $this->sendSuccess($data, 'lab test updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabTest $labTest)
    {
        $user = request()->user();

        if($user->roleHas('doctors') || $labTest->user_id == $user->id){
            $labTest->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'lab test deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['patients', 'emergency', 'hospital'];
    }
}

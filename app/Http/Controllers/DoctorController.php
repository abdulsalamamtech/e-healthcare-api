<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor = Doctor::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($doctor);
        $doctor->load($this->relationships());


        $data = DoctorResource::collection($doctor);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        $data = Doctor::create($request->validated());
        return $this->sendSuccess($data, 'doctor created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doctor->load($this->relationships());

        $data = new DoctorResource($doctor);
        return $this->sendSuccess($data, 'doctor fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        $data = new DoctorResource($doctor);
        return $this->sendSuccess($data, 'doctor updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $doctor->user_id == $user->id){
            $doctor->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'doctor deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user', 'appointments','treatments','prescriptions', 'labTests'];
    }
}

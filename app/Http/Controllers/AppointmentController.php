<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointment = Appointment::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($appointment);
        $appointment->load($this->relationships());


        $data = AppointmentResource::collection($appointment);
        return $this->sendSuccess(data: $data, metadata: $metaData);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = Appointment::create($request->validated());
        return $this->sendSuccess($data, 'Appointment created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load($this->relationships());

        $data = new AppointmentResource($appointment);
        return $this->sendSuccess($data, 'appointment fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $user = request()->user();

        if($user->roleHas('medical-doctors') || $appointment->user_id == $user->id){
            $appointment->update($request->validated());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $data = new AppointmentResource($appointment);
        return $this->sendSuccess($data, 'appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $appointment->user_id == $user->id){
            $appointment->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'appointment deleted successfully');

    }


    // Model relationships
    protected function relationships()
    {
        return ['patient','doctor', 'medicalOfficer'];
    }
}

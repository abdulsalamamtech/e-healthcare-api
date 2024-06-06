<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmergencyRequest;
use App\Http\Requests\UpdateEmergencyRequest;
use App\Models\Emergency;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmergencyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emergency $emergency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emergency $emergency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmergencyRequest $request, Emergency $emergency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emergency $emergency)
    {
        //
    }
}

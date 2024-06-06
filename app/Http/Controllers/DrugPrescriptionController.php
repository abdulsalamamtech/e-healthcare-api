<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrugPrescriptionRequest;
use App\Http\Requests\UpdateDrugPrescriptionRequest;
use App\Models\DrugPrescription;

class DrugPrescriptionController extends Controller
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
    public function store(StoreDrugPrescriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DrugPrescription $drugPrescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DrugPrescription $drugPrescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrugPrescriptionRequest $request, DrugPrescription $drugPrescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrugPrescription $drugPrescription)
    {
        //
    }
}

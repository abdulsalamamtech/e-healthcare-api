<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($payment);
        $payment->load($this->relationships());


        $data = PaymentResource::collection($payment);
        return $this->sendSuccess(data: $data, metadata: $metaData);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id ?? null;
        $validatedData['tracking_no'] = strtoupper(uniqid('EHC-PAY-TRK-'));

        $validatedData['session_id'] = strtoupper(uniqid('EHC-PAY-SES-')) . base64_encode(
            strtoupper(uniqid('session_id')) . now()
        );


        $data = Payment::create($validatedData);
        return $this->sendSuccess($data, 'payment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load($this->relationships());

        $data = new PaymentResource($payment);
        return $this->sendSuccess($data, 'payment fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        $data = new PaymentResource($payment);
        return $this->sendSuccess($data, 'payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        return $this->sendSuccess([], 'payment can not be deleted');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user'];
    }
}

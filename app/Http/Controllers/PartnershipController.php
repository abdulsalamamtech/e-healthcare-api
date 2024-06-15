<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Http\Resources\PartnershipResource;
use App\Http\Requests\StorePartnershipRequest;
use App\Http\Requests\UpdatePartnershipRequest;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Partnerships = Partnership::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($Partnerships);
        $Partnerships->load($this->relationships());


        $data = PartnershipResource::collection($Partnerships);
        return $this->sendSuccess(data: $data, metadata: $metaData);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnershipRequest $request)
    {
        $data = Partnership::create($request->validated());
        return $this->sendSuccess($data, 'Partnership created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $Partnership)
    {
        $Partnership->load($this->relationships());

        $data = new PartnershipResource($Partnership);
        return $this->sendSuccess($data, 'Partnership fetched successfully');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnershipRequest $request, Partnership $Partnership)
    {
        $user = request()->user();

        if($user->roleHas('doctors') || $Partnership->user_id == $user->id){
            $Partnership->update($request->validated());
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        $data = new PartnershipResource($Partnership);
        return $this->sendSuccess($data, 'Partnership updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partnership $Partnership)
    {
        $user = request()->user();

        if($user->roleHas('admin') || $Partnership->user_id == $user->id){
            $Partnership->delete();
        }else{
            abort(code: 403, message: 'unauthorized action');
        }

        return $this->sendSuccess([], 'Partnership deleted successfully');

    }

    // Model relationships
    protected function relationships()
    {
        return ['user'];
    }
}

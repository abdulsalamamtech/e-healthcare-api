<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserInfoRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Models\UserInfo;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userInfo = UserInfo::paginate();
        return $userInfo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserInfoRequest $request)
    {
        $userInfo = UserInfo::create($request->all());
        return $userInfo;
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInfo $userInfo)
    {
        return $userInfo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserInfoRequest $request, UserInfo $userInfo)
    {
        $userInfo->update($request->all());
        return $userInfo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInfo $userInfo)
    {
        $userInfo->delete();
        return ['user info deleted'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRoleRequest;
use App\Http\Requests\UpdateUserRoleRequest;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoles = UserRole::paginate();
        return $userRoles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRoleRequest $request)
    {
        $userRole = UserRole::create($request->all());
        return $userRole;
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRole $userRole)
    {
        return $userRole;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRoleRequest $request, UserRole $userRole)
    {
        $userRole = $userRole->update($request->all());
        return $userRole;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $userRole)
    {
        $userRole->delete();
        return  ['UserRole deleted'];
    }
}

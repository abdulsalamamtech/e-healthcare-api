<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate();
        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        return $role;
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role = $role->update($request->all());
        return $role;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return  ['role deleted'];
    }
}

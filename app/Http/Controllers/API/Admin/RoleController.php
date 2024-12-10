<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    use JsonResponseTrait ;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$roles->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role=Role::create($request->validated());
        return $this->responseSuccess('Added Successfully!',$role->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $this->responseSuccess('Data Retrieved Successfully!',$role->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$role->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::where('id',$role->id)->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
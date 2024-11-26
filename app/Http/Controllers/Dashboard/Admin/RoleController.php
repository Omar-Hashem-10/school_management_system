<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    use  SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.roles.index', $sideData ,compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.roles.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->validated());
        return redirect()->route('dashboard.admin.roles.index')->with('success', 'Role added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.roles.edit', $sideData ,compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->route('dashboard.admin.roles.index')->with('success', 'Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::where('id',$role->id)->delete();
        return redirect()->route('dashboard.admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::get()->all();
        return view('web.dashboard.admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('web.dashboard.admin.roles.create');

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('web.dashboard.admin.roles.edit',compact('role'));

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

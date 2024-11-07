<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $data=$request->validate(
            ['role_name' =>'required|string']
        );
        Role::create($data);
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
    public function update(Request $request, Role $role)
    {
        $data=$request->validate(
            ['role_name' =>'required|string']
        );
        Role::where('id',$role->id)->update($data);
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
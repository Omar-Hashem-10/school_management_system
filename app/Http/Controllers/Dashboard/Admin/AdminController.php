<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use SideDataTraits;
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return view('web.dashboard.admin.admins.index', $sideData, compact('admins'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('for',  'admins')->get();
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.admins.create', $sideData, compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $user=$this->createUser( $request,$data);  
        $admindata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'created_at' => now(),
        ];
        $admindata['user_id'] = $user->id;
        Admin::create($admindata);

        return redirect()->route('dashboard.admin.admins.index')->with('success', 'admin added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where('for', operator: 'admins')->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.admins.edit', $sideData, compact(['admin', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {

        $user = $admin->user;
        $data = $this->updateUser($request, $user);
        $admindata = [
            'created_at' => now(),
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
        ];
        $admin->update($admindata);
        return redirect()->route('dashboard.admin.admins.index')->with('success', 'Admin added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {

        try {
            $user = $admin->user;
            if ($admin) {
                $admin->delete();
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'Admin deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'This Admin cannot be deleted');
        }
    }
}
<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Traits\SideDataTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return view('web.dashboard.admin.admins.index', $sideData , compact('admins'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=Role::where('for',  'admins')->first();
        $roles=Role::where('for',  'admins')->get();

        if(!isset($role))
        return redirect()->back()->with('error','Not Found Role To Create Teacher');

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.admins.create', $sideData ,compact(['roles','role']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $data = $request->validated();
        $userData = [
            'name' => $data['admin_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
        ];
        $data = Arr::except($data, 'password');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/admins', 'public');
            $data['image'] = $filename;
        }
        $user = User::create($userData);
        $data['user_id'] = $user->id;
        Admin::create($data);

        return redirect()->route('dashboard.admin.admins.index')->with('success', 'admin added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles=Role::where('for', operator: 'admins')->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.admins.edit', $sideData , compact(['admin','roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $data = $request->validated();
        $userData = [
            'name' => $data['admin_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ];
        if ($data['password'] == $admin->user->password) {
            $userData['password'] = $admin->user->password;
        } else {
            $userData['password'] = $data['password'];
        }

        if ($request->hasFile('image')) {
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/admins', 'public');
            $data['image'] = $filename;
        }
        $data = Arr::except($data, 'password');
        User::where('id', $admin->user_id)->update($userData);
        Admin::where('id', $admin->id)->update($data);
        return redirect()->route('dashboard.admin.admins.index')->with('success', 'admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $user= User::where('id',$admin->user_id)->find;
        $imagePath = null;
        if ($admin->image) {
            $imagePath = $admin->image;
        }
        try {
            DB::beginTransaction();
            $admin->delete();
            if ($user) {
                $user->delete();
            }
            if ($imagePath) {
                // Delete the image from storage
                Storage::disk('public')->delete($imagePath);
            }
            DB::commit();
            return redirect()->back()->with('success', 'admin deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This admin can not be deleted');
        }
    }
}
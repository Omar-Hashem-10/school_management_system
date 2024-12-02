<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;
use App\Enums\UserTypesEnum;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\GuardianRequest;
use Illuminate\Support\Facades\Storage;

class GuardianController extends Controller
{
    use SideDataTraits;
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::orderBy('id', 'desc')->paginate(10);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.guardians.index', $sideData, compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::where('role_name', 'parent')->first();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.guardians.create', $sideData, compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardianRequest $request)
    {
        $data = $request->validated();
        $user = $this->createUser( $request,$data);
        $guardiandata = [
            'created_at' => now(),
            'role_id' => $data['role_id'],
            'user_id' => $user->id,
        ];
        Guardian::create($guardiandata);

        return redirect()->route('dashboard.admin.guardians.index')->with('success',  'Guardian added successfully');
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
    public function edit(Guardian $guardian)
    {
        $role = Role::where('role_name', 'parent')->first();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.guardians.edit', $sideData, compact('guardian', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Guardian $guardian, GuardianRequest $request)
    {
        // dd($user);
        $user = $guardian->user;
        $data = $this->updateUser($request, $user);
        $guardiandata = [
            'created_at' => now(),
            'role_id' => $data['role_id'],
            'user_id' => $user->id,
        ];
        $guardian->update($guardiandata);

        return redirect()->route('dashboard.admin.guardians.index')->with('success',  'Guardian updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {

        try {
            $user = $guardian->user;
            if ($guardian) {
                $guardian->delete();
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image()->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'Guardian deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'This Guardian cannot be deleted');
        }
    }
}
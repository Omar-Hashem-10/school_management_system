<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Admin;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!', $admins->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $user = $this->createUser($request, $data);
        $admindata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'created_at' => now(),
        ];
        $admindata['user_id'] = $user->id;
        $admin = Admin::create($admindata);
        return $this->responseSuccess('Added Successfully!', $admin->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return $this->responseSuccess('Data Retrieved Successfully!', $admin->toArray());
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
        return $this->responseSuccess('Updated Successfully!', $admin->toArray());
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
            return $this->responseSuccess('Deleted Successfully!');
        } catch (Exception $e) {
            return $this->responseFailure("Cannot Delete This Teacher",404);
        }
    }
}
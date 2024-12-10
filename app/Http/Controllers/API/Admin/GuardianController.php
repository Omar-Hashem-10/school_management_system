<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Guardian;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuardianRequest;
use Illuminate\Support\Facades\Storage;

class GuardianController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$guardians->toArray());
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
        $guardian=Guardian::create($guardiandata);

        return $this->responseSuccess('Added Successfully!',$guardian->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian)
    {
        return $this->responseSuccess('Data Retrieved Successfully!',$guardian->toArray());
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

        return $this->responseSuccess('Updated Successfully!',$guardian->toArray());

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
            return $this->responseSuccess('Deleted Successfully!');

        } catch (Exception $e) {
            return $this->responseFailure("Cannot Delete This Teacher",404);
        }
    }

}
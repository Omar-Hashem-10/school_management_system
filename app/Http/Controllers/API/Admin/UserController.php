<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Traits\UserTrait;

class UserController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$users->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->responseSuccess('Retrieved Successfully!',$user->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
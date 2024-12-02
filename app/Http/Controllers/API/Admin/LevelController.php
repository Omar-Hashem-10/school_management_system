<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Level;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\LevelRequest;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$levels->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelRequest $request)
    {
        $level = Level::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$level->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return $this->responseSuccess('Retrieved Successfully!',$level->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelRequest $request, Level $level)
    {
        $level->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$level->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}

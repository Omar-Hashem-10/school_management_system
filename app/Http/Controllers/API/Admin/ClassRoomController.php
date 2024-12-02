<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\ClassRoom;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomRequest;

class ClassRoomController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class_rooms = ClassRoom::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$class_rooms->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomRequest $request)
    {
        $class_room = ClassRoom::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$class_room->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $class_room)
    {
        return $this->responseSuccess('Retrieved Successfully!',$class_room->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomRequest $request, ClassRoom $class_room)
    {
        $class_room->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$class_room->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class_room)
    {
        $class_room->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}

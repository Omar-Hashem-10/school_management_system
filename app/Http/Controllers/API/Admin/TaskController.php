<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Task;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        $teacher_id = $request->query('teacher_id');
        $class_room_id = $request->query('teacher_id');
        $tasks = Task::where('teacher_id', $teacher_id)->where('class_room_id', $class_room_id)->where('academic_year_id', $academicYear->id)->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$tasks->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if (!$academicYear) {
            return $this->responseFailure('No academic year found.', 404);
        }

        $taskData = $request->validated();
        $taskData['academic_year_id'] = $academicYear->id;

        $task = Task::create($taskData);

        return $this->responseSuccess('Created Successfully!', $task->toArray());
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $this->responseSuccess('Retrieved Successfully!',$task->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$task->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}

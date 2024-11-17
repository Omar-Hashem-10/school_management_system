<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Task;
use App\Models\Feedback;
use App\Models\TaskSend;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskSendRequest;

class TaskController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();

        $course_level_id = $request->query('course_level_id');
        if ($course_level_id) {
            session()->put('course_level_id', $course_level_id);
        }

        $tasks = Task::where('course_level_id', session('course_level_id'))
                     ->paginate(5);

        $taskLinks = TaskSend::where('student_id', session('student_id'))
                             ->pluck('task_link', 'task_id')
                             ->toArray();

        $task_ids = array_keys($taskLinks);

        $feedbacks = Feedback::where('student_id', session('student_id'))
                             ->whereIn('task_id', $task_ids)
                             ->get();

        return view('web.dashboard.student.task.index', array_merge($sideData, compact('tasks', 'taskLinks', 'task_ids', 'feedbacks')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($taskId)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.student.task.create', $sideData, compact('taskId'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskSendRequest $request)
    {
        $task = TaskSend::create($request->validated());
        return redirect()->route('dashboard.student.task.index')->with('success', 'Send Task Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

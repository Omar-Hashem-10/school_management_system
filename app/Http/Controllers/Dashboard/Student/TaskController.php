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

        $course_code_id = $request->query('course_code');
        if ($course_code_id) {
            session()->put('course_code_id', $course_code_id);
        }

        $tasks = Task::where('course_code_id', session('course_code_id'))->where('class_room_id', auth()->user()->student->class_room_id)
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
}

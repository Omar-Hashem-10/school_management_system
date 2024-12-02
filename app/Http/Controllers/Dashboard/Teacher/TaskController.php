<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Task;
use App\Models\Teacher;
use App\Models\Feedback;
use App\Models\TaskSend;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Traits\SideDataTraits;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if ($academicYear) {
            session()->put('academic_year_id', $academicYear->id);
        }
        $sideData = $this->getSideData();
        $class_room_id = $request->query('class_room_id');
        if (!empty($class_room_id)) {
            session(['class_room_id' => $class_room_id]);
        }
        $tasks = Task::where('teacher_id', session('teacher_id'))->where('class_room_id', session('class_room_id'))->where('academic_year_id', session('academic_year_id'))->paginate(5);
        return view('web.dashboard.teacher.tasks.index', $sideData, compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();

        $teacher = Teacher::find(session('teacher_id'));

        if ($teacher) {
            $course_code_id = $teacher->courseCodes()
                                        ->where('teacher_id', session('teacher_id'))
                                        ->where('class_room_id', session('class_room_id'))
                                        ->pluck('course_code_id')
                                        ->first();

            if ($course_code_id) {
                session()->put('course_code_id', $course_code_id);
            }
        }

        return view('web.dashboard.teacher.tasks.create', $sideData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('dashboard.teacher.tasks.index')->with('success', 'Created Task Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $sideData = $this->getSideData();

        $students = TaskSend::where('task_id', $task->id)
            ->with('student')
            ->select('task_sends.*', 'task_sends.task_link')
            ->paginate(5);

            session()->put('task', $task);

            $feedbacks = Feedback::where('task_id', $task->id)->get();

        return view('web.dashboard.teacher.tasks.show', $sideData, compact('students', 'feedbacks'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.teacher.tasks.edit', $sideData, compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('dashboard.teacher.tasks.index')->with('success', 'Updated Task Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard.teacher.tasks.index')->with('success', 'Deleted Task Successfully!');
    }
}

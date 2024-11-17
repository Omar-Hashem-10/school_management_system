<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Task;
use App\Models\Student;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($student_id, $task_id)
    {
        $sideData = $this->getSideData();
        $task = Task::findOrFail($task_id);
        $student = Student::findOrFail($student_id);
        return view('web.dashboard.teacher.feedback.create', $sideData, compact('student_id', 'task', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedbackRequest $request)
    {
        Feedback::create($request->validated());
        return redirect()->route('dashboard.teacher.tasks.show', session('task'))->with('success', 'Created Feedback Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.teacher.feedback.show', $sideData, compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.teacher.feedback.edit', $sideData, compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->validated());
        return redirect()->route('dashboard.teacher.tasks.show', session('task'))->with('success', 'Updeate Feedback Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

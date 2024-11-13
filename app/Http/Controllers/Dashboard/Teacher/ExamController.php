<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Exam;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;
use App\Traits\SideDataTraits;

class ExamController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $class_room_id = $request->query('class_room_id');
        if (!empty($class_room_id)) {
            session(['class_room_id' => $class_room_id]);
        }
        $sideData = $this->getSideData();
        $exams = Exam::paginate(5);
        return view('web.dashboard.teacher.exams.index', $sideData, compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course_level = CourseTeacher::where('teacher_id', session('teacher_id'))
                                        ->where('class_room_id', session('class_room_id'))
                                        ->first();

        if ($course_level) {
            session(['course_level_id' => $course_level->id]);
        }

        $sideData = $this->getSideData();


        return view('web.dashboard.teacher.exams.create', $sideData);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $exam = Exam::create($request->validated());

        $examId = $exam->id;

        session()->put('exam_id', $examId);

        return redirect()->route('dashboard.teacher.exam-questions.create')
                            ->with('success', 'Created Exam Now Add Questions');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {

        $sideData = $this->getSideData();

        return view('web.dashboard.teacher.exams.edit',$sideData, compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        return redirect()->route('dashboard.teacher.exams.index', ['class_room_id' => session('class_room_id')])->with('success','Updated Exam Information Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('dashboard.teacher.exams.index', ['class_room_id' => session('class_room_id')])->with('success','Deleted Exam Successfully!');
    }
}
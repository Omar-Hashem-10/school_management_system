<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Exam;
use App\Models\Answer;
use App\Models\AcademicYear;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    use SideDataTraits;
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();
        $course_code_id = $request->query('course_code');

        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        $payments = Payment::where('student_id', auth()->user()->student->id)
        ->where('academic_year_id', $academicYear->id)
        ->get();

        if ($payments->isEmpty()) {
            return redirect()->back()->with('error', 'No payments found for the current academic year.');
        }

        if ($academicYear) {
            session()->put('academic_year_id', $academicYear->id);
        }

        $exams = Exam::where('course_code_id', $course_code_id)->where('class_room_id', auth()->user()->student->class_room_id)
            ->where('academic_year_id', session('academic_year_id'))
            ->with(['grades' => function ($query) {
                $query->where('student_id', auth()->user()->student->id);
            }])
            ->get();

        $exam_ids = Answer::with('question')->where('student_id', auth()->user()->student->id)
            ->distinct()
            ->pluck('exam_id')
            ->toArray();

        session()->put('course_code_id', $course_code_id);

        return view('web.dashboard.student.exam.index', $sideData, compact('exams', 'exam_ids'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $sideData = $this->getSideData();
        $questions = $exam->paginate(2);

        $totalQuestions = $questions->total();

        session()->put('total_questions', $totalQuestions);

        return view('web.dashboard.student.exam.show', array_merge($sideData, compact('exam', 'questions', 'totalQuestions')));
    }



}
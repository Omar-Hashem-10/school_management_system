<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Traits\SideDataTraits;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if ($academicYear) {
            session()->put('academic_year_id', $academicYear->id); // session()->put('academic_year', $academicYear); edit
        }

        $class_room_id = $request->query('class_room_id');
        if (!empty($class_room_id)) {
            session(['class_room_id' => $class_room_id]);
        }
        $sideData = $this->getSideData();
        $exams = Exam::where('class_room_id', session('class_room_id'))->where('teacher_id', session('teacher_id'))->where('academic_year_id', session('academic_year_id'))->paginate(5);
        return view('web.dashboard.teacher.exams.index', $sideData, compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        if (Question::where('course_code_id', session('course_code_id'))->doesntExist()) {
            return redirect()->back()->with('error', 'No Questions In The Course Code');
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

    public function show(Exam $exam)
    {
        $questions = $exam->questions()->with('choices')->paginate(5);

        $questions->getCollection()->transform(function ($question) {
            $question->pivot->question_grade;
            return $question;
        });

        $sideData = $this->getSideData();

        return view('web.dashboard.teacher.exams.show', $sideData, compact('exam', 'questions'));
    }



    public function showStudents(Exam $exam)
    {
        $sideData = $this->getSideData();

        $students = Student::whereIn('id', function ($query) use ($exam) {
            $query->select('student_id')
                  ->from('grades')
                  ->where('exam_id', $exam->id);
            })->paginate(5);


        return view('web.dashboard.teacher.exams.show-students', $sideData, compact('students', 'exam'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
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

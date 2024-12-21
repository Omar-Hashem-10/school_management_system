<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Student;
use App\Models\Schedule;
use App\Models\CourseCode;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Type\Decimal;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke()
    {
        abort_if(!Gate::allows('isStudent'), 403);

        session()->put('allowdFromStudent', 1);

        session()->put('student_id', auth()->user()->student->id);

        $this->getProfileData(Student::class);

        $student=Student::with(['user','payments','classRoom','classRoom.courseCodes','grades','grades.exam','classRoom.level','certificates'])->where('user_id',auth()->user()->id)->first();
        session()->put('student', $student);
        $gradeStudent=0;
        $totalGrade=0;
        foreach($student->grades as $grade ){
            $gradeStudent=$gradeStudent+$grade->grade;
            $totalGrade=$totalGrade+($grade->exam->half_grade)*2;
        }
        $gpaPercentage = ($totalGrade>0)?($gradeStudent/$totalGrade)*100 : 0;
        // dd($student->certificates[0]);
        if(isset($student->certificates[0]))
        {
            $gradeStudent=$gradeStudent+$student->certificates[0]->obtained_marks;
            $totalGrade=$totalGrade+$student->certificates[0]->total_marks;
            $gpaPercentage = ($totalGrade>0)?($gradeStudent/$totalGrade)*100 : 0;
        }


        return view('web.dashboard.student.home.index', compact(['student','gpaPercentage']));
    }

}

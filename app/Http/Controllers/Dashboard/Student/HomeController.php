<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\CourseCode;
use App\Traits\DataTraits;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke()
    {
        abort_if(!Gate::allows('isStudent'), 403);

        session()->put('allowdFromStudent', 1);

        session()->put('student_id', auth()->user()->student->id);
        
        $this->getProfileData(Student::class);
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        session()->put('academic_year', $academicYear);
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
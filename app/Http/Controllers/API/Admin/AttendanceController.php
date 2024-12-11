<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Attend;
use App\Models\Student;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $student_id = $request->query('student_id');
        $student = Student::find($student_id);
        $academic_year_id = $request->query('academic_year_id');

        if($academic_year_id)
        {
            $attendances = Attend::where('attendable_id', $student->user->id)->where('academic_year_id', $academic_year_id)->get();
        }else{
            $attendances = Attend::where('attendable_id', $student->user->id)->get();
        }



        return $this->responseSuccess('Data Retrieved Successfully!',$attendances->toArray());
    }
}

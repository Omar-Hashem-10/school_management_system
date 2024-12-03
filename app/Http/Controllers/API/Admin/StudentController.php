<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Grade;
use App\Models\Attend;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user', 'guardian'])->orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!', $students->toArray());
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $grades = Grade::where('student_id', $student->id)->get();

        $attendanse = Attend::where('attendable_id', $student->user->id)->get();

    $data = [
            'grades' => $grades->toArray(),
            'attendance' => $attendanse->toArray(),
        ];

        return $this->responseSuccess('Data Retrieved Successfully!', $data);
    }

}

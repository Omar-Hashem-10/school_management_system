<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Grade;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeExamController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $academic_year_id = $request->query('academic_year_id');

            $student_id = $request->query('student_id');
            if($academic_year_id)
            {
                $grades = Grade::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
            }else{
                $grades = Grade::where('student_id', $student_id)->get();
             }
            return $this->responseSuccess('Data Retrieved Successfully!',$grades->toArray());
        }
}

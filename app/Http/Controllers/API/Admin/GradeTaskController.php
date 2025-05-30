<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class GradeTaskController extends Controller
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
            $grades = Feedback::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        }else{
            $grades = Feedback::where('student_id', $student_id)->get();
        }

        return $this->responseSuccess('Data Retrieved Successfully!',$grades->toArray());
    }
}

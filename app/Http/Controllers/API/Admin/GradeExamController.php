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
        $student_id = $request->query('student_id');

        $grades = Grade::where('student_id', $student_id)->get();

        return $this->responseSuccess('Data Retrieved Successfully!',$grades->toArray());
    }
}

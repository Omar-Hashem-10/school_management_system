<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionTrueFalseController extends Controller
{
    use DataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sideData = $this->getSideData();
        $course_level_id = session('course_level_id');
        return view('web.dashboard.teacher.questions.true_false_questions.create', $sideData , compact( 'course_level_id'));
    }
}
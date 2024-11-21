<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class QuestionMCQController extends Controller
{
    use SideDataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sideData = $this->getSideData();
        $course_code_id = session('course_code_id');
        return view('web.dashboard.teacher.questions.mcq_questions.create', $sideData , compact('course_code_id'));
    }
}

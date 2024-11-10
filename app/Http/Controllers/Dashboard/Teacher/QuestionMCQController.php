<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Http\Controllers\Controller;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;

class QuestionMCQController extends Controller
{
    use SideDataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sideData = $this->getSideData();
        $course_level_id = session('course_level_id');
        return view('web.dashboard.teacher.questions.mcq_questions.create', $sideData , compact('course_level_id'));
    }
}

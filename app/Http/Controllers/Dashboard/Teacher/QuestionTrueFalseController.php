<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionTrueFalseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');
        $course_level_id = session('course_level_id');
        return view('web.dashboard.teacher.questions.true_false_questions.create', compact('class_room_names', 'course_codes', 'course_level_id'));
    }
}

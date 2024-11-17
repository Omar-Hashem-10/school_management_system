<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    use SideDataTraits;
    /**
     * Display the feedback details.
     *
     * @param  int  $feedbackId
     * @return \Illuminate\View\View
     */
    public function __invoke($feedbackId)
    {
        $sideData = $this->getSideData();

        $feedback = Feedback::findOrFail($feedbackId);

        return view('web.dashboard.student.feedback.show', $sideData, compact('feedback'));
    }
}

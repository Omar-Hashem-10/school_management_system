<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Exam;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $class_room_id = $request->query('class_room_id');
        $teacher_id = $request->query('teacher_id');
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        $exams = Exam::where('class_room_id', $class_room_id)->where('teacher_id', $teacher_id)->where('academic_year_id', $academicYear->id)->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$exams->toArray());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if (!$academicYear) {
            return $this->responseFailure('No academic year found.', 404);
        }

        $taskData = $request->validated();
        $taskData['academic_year_id'] = $academicYear->id;

        $exam = Exam::create($taskData);
        $exam_id = $exam->id;
        $question_ids = $request->input('questions');
        $scores = $request->input('scores');

        if (empty($question_ids)) {
        return $this->responseFailure('Please select at least one question.',404);
        }

        $exam = Exam::findOrFail($exam_id);
        $total_score = 0;

        foreach ($question_ids as $question_id) {
            $score = isset($scores[$question_id]) ? $scores[$question_id] : 0;
            $total_score += $score;
        }

        if ($total_score < $exam->half_grade) {
        return $this->responseFailure('The total score is less than the required half grade.',404);
        }

        if ($total_score != $exam->half_grade * 2) {
        return $this->responseFailure('The total score is exactly double the required half grade.',404);
        }

        foreach ($question_ids as $question_id) {
            $score = isset($scores[$question_id]) ? $scores[$question_id] : 0;
            $exam->questions()->attach($question_id, ['question_grade' => $score]);
        }

        return $this->responseSuccess('Created Successfully!',$exam->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return $this->responseSuccess('Retrieved Successfully!',$exam->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, Exam $exam)
{
    $exam->update($request->validated());

    $question_ids_all = $request->input('questions_not_in_exam', []);
    $scores = $request->input('scores', []);

    foreach ($question_ids_all as $question_id) {
        if (!$exam->questions->contains($question_id)) {
            $exam->questions()->syncWithoutDetaching([
                $question_id => [
                    'question_grade' => $scores[$question_id] ?? 0,
                ]
            ]);
        }
    }

    $question_ids = $request->input('questions_in_exam', []);
    $current_question_ids = $exam->questions->pluck('id')->toArray();

    $removed_question_ids = array_diff($current_question_ids, $question_ids);
    if (!empty($removed_question_ids)) {
        $exam->questions()->detach($removed_question_ids);
    }

    foreach ($question_ids as $question_id) {
        $exam->questions()->updateExistingPivot($question_id, [
            'question_grade' => $scores[$question_id] ?? 0,
        ]);
    }
    $total_score = 0;
    foreach ($question_ids as $question_id) {
        $total_score += $scores[$question_id] ?? 0;
    }

    if ($total_score < $exam->half_grade) {
        return $this->responseFailure('The total score is less than the required half grade.', 404);
    }

    if ($total_score != $exam->half_grade * 2) {
        return $this->responseFailure('The total score is not equal to double the required half grade.', 404);
    }

    if (count($question_ids) > 0) {
        return $this->responseSuccess('Questions updated successfully.', $exam->toArray());
    } else {
        return $this->responseFailure('Please select at least one question.', 404);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}

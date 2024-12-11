<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Certificate;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateGradeController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(String $id, Request $request)
    {

        $academic_year_id = $request->query('academic_year_id');

        // العثور على الطالب باستخدام الـ ID
        $student = Student::findOrFail($id);
        $studentData = [
            'id' => $student->id,
            'first_name' => $student->user->first_name,
            'last_name' => $student->user->last_name,
        ];

        if ($academic_year_id) {
            $certificateQuery = Certificate::where('student_id', $student->id)
                ->where('academic_year_id', $academic_year_id)
                ->get();
        } else {
            $certificateQuery = Certificate::where('student_id', $student->id)->get();
        }

        $certificate = $certificateQuery->firstOrFail(); // تأكد من الحصول على شهادة واحدة فقط

        // إذا لم توجد شهادة، الرد برسالة فشل
        if (!$certificate) {
            return $this->responseFailure('No certificate found for this student and academic year.', 404);
        }

        // تفاصيل الشهادة
        $certificateDetails = [
            'id' => $certificate->id,
            'total_marks' => $certificate->total_marks,
            'obtained_marks' => $certificate->obtained_marks,
            'percentage' => $certificate->percentage,
            'grade' => $certificate->grade,
            'academic_year' => $certificate->academicYear->year,
        ];

        // الحصول على المواضيع وجمع التفاصيل حولها
        $subjects = Subject::with('levels')->get();
        $results = $certificate->courseCodes->map(function ($courseCode) use ($subjects) {
            $levelSubject = $subjects->flatMap(function ($subject) {
                return $subject->levels->map(function ($level) use ($subject) {
                    return [
                        'level' => $level,
                        'subject_name' => $subject->name,
                    ];
                });
            })->firstWhere('level.pivot.id', $courseCode->level_subject_id);

            return [
                'subject_name' => $levelSubject['subject_name'] ?? 'N/A',
                'course_code' => $courseCode->code,
                'subject_marks' => $levelSubject['level']->pivot->subject_marks ?? 0,
            ];
        });

        // إعداد الاستجابة
        $response = [
            'student' => $studentData,
            'certificate' => $certificateDetails,
            'results' => $results,
        ];

        return $this->responseSuccess('Certificate details retrieved successfully!', $response);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

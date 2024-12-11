<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Subject;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateSubjectRequest;

class CertificateSubjectController extends Controller
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
    public function store(CertificateSubjectRequest $request)
    {
        $validatedData = $request->validated();

        if($validatedData['subject_marks'])
        {
            session()->put('subject_marks', $validatedData['subject_marks']);
        }

        $certificate = Certificate::findOrFail($validatedData['certificate_id']);

        $certificate->courseCodes()->attach($validatedData['course_code_id'], [
            'subject_marks' => $validatedData['subject_marks']
        ]);

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
                'subject_marks' => session('subject_marks'),
            ];
        });

        return $this->responseSuccess('Created Successfully!', [
            'results' => $results
        ]);
    }




    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificateSubjectRequest $request, $id)
    {
        $validatedData = $request->validated();

        if ($validatedData['subject_marks']) {
            session()->put('subject_marks', $validatedData['subject_marks']);
        }

        // البحث عن سجل في جدول الوسيط certificate_courses
        $certificateSubject = DB::table('certificate_courses')->where('id', $id)->first();

        if (!$certificateSubject) {
            return $this->responseFailure('Certificate subject record not found', 404);
        }

        // البحث عن الشهادة باستخدام المعرف
        $certificate = Certificate::where('id', $validatedData['certificate_id'])->first();

        // تحديث العلاقة للمواضيع المرتبطة مع علامات الموضوع
        DB::table('certificate_courses')
            ->where('id', $id)
            ->update([
                'subject_marks' => $validatedData['subject_marks'],
            ]);

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
                'subject_marks' => session('subject_marks'),
            ];
        });

        return $this->responseSuccess('Updated Successfully!', [
            'results' => $results
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate_course = DB::table('certificate_courses')->where('id', $id)->first();

        if (!$certificate_course) {
            return $this->responseFailure('Certificate Course record not found', 404);
        }

        DB::table('certificate_courses')->where('id', $id)->delete();

        return $this->responseSuccess('Certificate Course record deleted successfully');
    }
}

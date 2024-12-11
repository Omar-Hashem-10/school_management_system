<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Certificate;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateRequest;

class CertificateController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $student_id = $request->query('student_id');
        $academic_year_id = $request->query('academic_year_id');

        if($student_id)
        {
            session()->put('student_id', $student_id);
        }


        if($academic_year_id)
        {
            $certificates = Certificate::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        }else{
            $certificates = Certificate::where('student_id', $student_id)->get();
        }
        return $this->responseSuccess('Data Retrieved Successfully!',$certificates->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateRequest $request)
    {
        $data = $request->validated();
        $student_id = $data['student_id'];

        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        $certificateCheck = Certificate::where('student_id', $student_id)
            ->where('academic_year_id', $academicYear->id)
            ->first();

        if ($certificateCheck) {
            return $this->responseFailure('There is already a certificate for this semester.', 404);
        }

        $certificate = Certificate::create($data);

        return $this->responseSuccess('Created Successfully!', $certificate->toArray());
    }


    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $student = [
            'id' => $certificate->student->id,
            'first_name' => $certificate->student->user->first_name,
            'last_name' => $certificate->student->user->last_name,
        ];

        $certificateDetails = [
            'id' => $certificate->id,
            'total_marks' => $certificate->total_marks,
            'obtained_marks' => $certificate->obtained_marks,
            'percentage' => $certificate->percentage,
            'grade' => $certificate->grade,
            'academic_year' => $certificate->academicYear->year,
        ];

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

        $response = [
            'student' => $student,
            'certificate' => $certificateDetails,
            'results' => $results,
        ];

        return $this->responseSuccess('Certificate details retrieved successfully!', $response);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();
        $student_id = $data['student_id'];

        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        $certificateCheck = Certificate::where('student_id', $student_id)
            ->where('academic_year_id', $academicYear->id)
            ->first();

        if ($certificateCheck && $certificateCheck->id !== $certificate->id) {
            return $this->responseFailure('There is already a certificate for this semester.', 404);
        }

        $certificate->update($data);

        return $this->responseSuccess('Updated Successfully!', $certificate->toArray());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}

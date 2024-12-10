<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\CourseCode;
use App\Models\Certificate;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;
use App\Http\Requests\CertificateSubjectRequest;

class CertificateSubjectController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::findOrFail(session('student_id'));

        $certificateId = session('certificateId');
        $level = $student->classRoom->level;
        $subjects = Subject::with('levels')->get();
        $course_codes = CourseCode::get();
        $sideData = $this->getSideData();

        $level_id = $level ? $level->id : null;

        return view('web.dashboard.admin.certificate_subject.create', array_merge($sideData, [
            'certificateId' => $certificateId,
            'subjects' => $subjects,
            'course_codes' => $course_codes,
            'level_id' => $level_id
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateSubjectRequest $request)
    {
        $validatedData = $request->validated();

        $certificate = Certificate::findOrFail($validatedData['certificate_id']);

        $certificate->courseCodes()->attach($validatedData['course_code_id'], [
            'subject_marks' => $validatedData['subject_marks']
        ]);

        return redirect()->back()->with('success', 'Subject added successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

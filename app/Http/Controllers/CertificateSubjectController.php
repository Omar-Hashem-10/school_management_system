<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\CourseCode;
use App\Models\Certificate;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
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
        $academicYear = AcademicYear::findOrFail(session('academic_year_id'));

        if ($academicYear->semester == 'Term 1') {
            $course_codes = CourseCode::where('semester', 'first')->get();
        } else {
            $course_codes = CourseCode::where('semester', 'second')->get();
        }

        $student = Student::findOrFail(session('student_id'));

        $level = $student->classRoom->level;
        $subjects = Subject::with('levels')->get();
        $sideData = $this->getSideData();

        $level_id = $level ? $level->id : null;

        $count = 0;
        foreach ($course_codes as $course) {
            foreach ($subjects as $subject) {
                foreach ($subject->levels as $level) {
                    if ($course->level_subject_id == $level->pivot->id && $level->id == $level_id) {
                        $count++;
                    }
                }
            }
        }

        session()->put('count', $count);

        return view('web.dashboard.admin.certificate_subject.create', array_merge($sideData, [
            'certificateId' => session('certificateId'),
            'subjects' => $subjects,
            'course_codes' => $course_codes,
            'level_id' => $level_id,
            'count' => $count
        ]));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateSubjectRequest $request)
    {
        $validatedData = $request->validated();

        $certificate = Certificate::findOrFail($validatedData['certificate_id']);

            $existingCourse = $certificate->courseCodes()
            ->wherePivot('course_code_id', $validatedData['course_code_id'])
            ->first();

        if ($existingCourse) {
            return redirect()->back()->with('error', 'The subject already exists for this certificate.');
        }

        $currentTotalMarks = \DB::table('certificate_courses')
            ->where('certificate_id', $validatedData['certificate_id'])
            ->sum('subject_marks');

        $newTotalMarks = $currentTotalMarks + $validatedData['subject_marks'];
        $maxMarks = $certificate->obtained_marks;

        session()->put('maxMarks', $maxMarks);
        session()->put('newTotalMarks', $newTotalMarks);

        if ($newTotalMarks > $maxMarks) {
            return redirect()->back()->with('error', "The total marks exceed the allowed limit of $maxMarks.");
        } elseif ($newTotalMarks < 0) {
            return redirect()->back()->with('error', "The total marks cannot be less than 0.");
        }

        $certificate->courseCodes()->attach($validatedData['course_code_id'], [
            'subject_marks' => $validatedData['subject_marks']
        ]);

        $currentCourseCount = \DB::table('certificate_courses')
        ->where('certificate_id', $validatedData['certificate_id'])
        ->count();

        session()->put('currentCourseCount', $currentCourseCount);

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
    public function edit(Certificate $certificate)
    {
        $student = Student::findOrFail(session('student_id'));

        $level = $student->classRoom->level;
        $subjects = Subject::with('levels')->get();
        $certificateSubjects = $certificate->courseCodes()->get();
        $course_codes = CourseCode::get();
        $sideData = $this->getSideData();

        $level_id = $level ? $level->id : null;

        return view('web.dashboard.admin.certificate_subject.edit', array_merge($sideData, [
            'certificate' => $certificate,
            'subjects' => $subjects,
            'course_codes' => $course_codes,
            'level_id' => $level_id,
            'certificateSubjects' => $certificateSubjects
        ]));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CertificateSubjectRequest $request, string $id)
    {
        $certificate = Certificate::findOrFail($id);

        $newTotalMarks = collect($request->subject_marks)->sum();

        $maxMarks = $certificate->obtained_marks;

        if ($newTotalMarks > $maxMarks) {
            return redirect()->back()->with('error', "The total marks exceed the allowed limit of $maxMarks.");
        } elseif ($newTotalMarks < 0) {
            return redirect()->back()->with('error', "The total marks cannot be less than 0.");
        }

        $certificate->courseCodes()->sync(
            collect($request->subject_marks)->mapWithKeys(function ($marks, $subjectId) use ($request) {
                return [
                    $request->course_code_id[$subjectId] => [
                        'subject_marks' => $marks,
                    ],
                ];
            })->toArray()
        );

        return redirect()->route('dashboard.admin.certificates.index')->with('success', 'Certificate subjects updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

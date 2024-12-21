<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;
use App\Models\CourseCode;
use App\Models\Certificate;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\CertificateRequest;

class CertificateController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();

            $previousUrl = url()->previous();

            if (preg_match('/\/certificate_subjects\/\d+\/edit/', $previousUrl) || str_contains($previousUrl, '/certificate_subjects/create')) {
                $maxMarks = session('maxMarks');
                $newTotalMarks = session('newTotalMarks');

                if ($maxMarks && $newTotalMarks) {
                    if ($newTotalMarks < $maxMarks) {
                        return redirect()->back()->with('error', "The total marks are less than the allowed limit ($maxMarks).");
                    }
                }

                if (session('currentCourseCount') != session('count')) {
                    // dd(session('count'));
                    return redirect()->back()->with('error', 'The number of subjects does not match the expected value.');
                }
            }



        $student_id = $request->query('student_id');

        if($student_id)
        {
            session()->put('student_id', $student_id);
        }

        $student = Student::findOrFail(session('student_id'));

        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if($student)
        {
            session()->put('student_id', $student->id);
            session()->put('level_id', $student->classRoom->level->id);
        }

        if($academicYear)
        {
            session()->put('academic_year_id', $academicYear->id);
        }

        $certificates = Certificate::with('student', 'level')->where('student_id', $student->id)->get();

        return view('web.dashboard.admin.certificate.index', $sideData, compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::findOrFail(session('student_id'));

        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        $certificateCheck = Certificate::where('student_id', $student->id)
            ->where('academic_year_id', $academicYear->id)
            ->first();

        if ($certificateCheck) {
            return redirect()->route('dashboard.admin.certificates.index')->with('error', 'There is already a certificate for this semester.');
        }
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.certificate.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateRequest $request)
    {

        $certificate = Certificate::create($request->validated());

        if ($certificate) {
            $certificateId = $certificate->id;
            session()->put('certificateId', $certificateId);
        }

        return redirect()->route('dashboard.admin.certificate_subjects.create')->with('success', 'Created certificate Now Add courses');
    }


    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $results = $certificate->courseCodes()->get();

        $subjects = Subject::with('levels')->get();

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.certificate.show', array_merge($sideData, compact('certificate', 'results', 'subjects')));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.certificate.edit', $sideData, compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $certificate->update($request->validated());
        return redirect()->route('dashboard.admin.certificates.index')->with('success', 'Updated Certificate Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('dashboard.admin.certificates.index')->with('success', 'Delete Certificate Successfully!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();
        $studentId = $request->query('student_id');
        $certificates = Certificate::where('student_id', $studentId)->get();
        return view('web.dashboard.guardian.certificate.index', $sideData, compact('certificates'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $sideData = $this->getSideData();

        $results = $certificate->courseCodes()->get();

        $subjects = Subject::with('levels')->get();

        return view('web.dashboard.guardian.certificate.show', array_merge($sideData, compact('certificate', 'results', 'subjects')));

    }
}

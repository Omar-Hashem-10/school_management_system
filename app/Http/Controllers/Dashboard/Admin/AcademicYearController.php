<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\ClassRoom;
use App\Models\Level;
use App\Models\Student;
use App\Models\Certificate;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicYearRequest;

class AcademicYearController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $academic_years = AcademicYear::paginate('5');
        return view('web.dashboard.admin.academic-years.index', $sideData, compact('academic_years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.academic-years.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicYearRequest $request)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        $certificates = Certificate::where('academic_year_id', $academicYear->id)->get();

        $totalStudents = Student::count();

        if ($certificates->count() !== $totalStudents) {
            return redirect()->back()->with('error', 'The number of certificates does not match the total number of students.');
        }

        if ($certificates->isNotEmpty()) {
            AcademicYear::create($request->validated());

            $studentsBelowHalf = collect();

            foreach ($certificates as $certificate) {
                $student = Student::findOrFail($certificate->student_id);

                if ($student) {
                    $currentLevel = $student->classRoom->level_id;

                    $nextLevel = Level::where('id', '>', $currentLevel)->orderBy('id', 'asc')->first();

                    if ($nextLevel) {
                        $classRoom = ClassRoom::where('level_id', $nextLevel->id)->first();

                        if ($classRoom && $certificate->obtained_marks < $certificate->total_marks / 2) {
                            $studentsBelowHalf->push($student);
                        } elseif ($classRoom && $academicYear->semester == 'Term 2') {
                            $student->update(['class_room_id' => $classRoom->id]);
                        }
                    }else{
                        $student->update(['graduate' => true]);
                    }
                }
            }

        } else {
            return redirect()->back()->with('error', 'No certificates found for the specified academic year.');
        }

        return redirect()->route('dashboard.admin.academic-years.index')->with('success', 'Academic Year created successfully.');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.academic-years.edit', $sideData, compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicYearRequest $request, AcademicYear $academicYear)
    {
        $academicYear->update($request->validated());
        return redirect()->route('dashboard.admin.academic-years.index')->with('success', 'Updated Academic Year');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return redirect()->route('dashboard.admin.academic-years.index')->with('success', 'Deleted Academic Year');
    }
}

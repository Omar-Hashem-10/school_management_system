<?php

namespace App\Http\Controllers\Dashboard\Admin;

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
        AcademicYear::create($request->validated());
        return redirect()->route('dashboard.admin.academic-years.index')->with('success', 'Created Academic Year');
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

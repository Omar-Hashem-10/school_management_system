<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.employees.index', $sideData, compact('employees'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.employees.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data=$request->validated();
        $employee=Employee::create($data);
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete('public/' . $employee->image->path);
                $employee->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $employee->image()->create([
                'path' => $filename,
            ]);
        }
        return redirect()->back()->with('success','Employee Added successfully!');
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
    public function edit(Employee $employee)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.employees.edit', $sideData,compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data=$request->validated();
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete('public/' . $employee->image->path);
                $employee->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $employee->image()->create([
                'path' => $filename,
            ]);
        }
        $employee->Update($data);
        return redirect()->route('dashboard.admin.employees.index')->with('success','Employee Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image?->path);
                $employee->image()->delete();
            }
            $employee->delete();
            return redirect()->back()->with('success', 'employee deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'This employee cannot be deleted');
        }
    }
}
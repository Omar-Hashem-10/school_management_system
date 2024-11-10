<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Teacher;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    use SideDataTraits;
    public function index()
    {
        $salaries = Salary::with('person')->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.index', $sideData , compact('salaries'));
    }
    public function create()
    {
        $teachers = Teacher::select('id', 'teacher_name')->get()->all();

        $employees = Employee::select('id', 'employee_name')->get()->all();

        $admins = Admin::select('id', 'admin_name')->get()->all();

        $people = [
            'teacher' => $teachers,
            'employee' => $employees,
            'admin' => $admins,
        ];

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.salaries.create', $sideData , compact('people'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|string',
            'base_salary' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:1900|max:2099',
        ]);

        list($personType, $personId) = explode('-', $data['person_id']);
        if ($personType === 'teacher') {
            $person = Teacher::find($personId);
        } elseif ($personType === 'admin') {
            $person = Admin::find($personId);
        } else {
            $person = Employee::find($personId);
        }
        $data['role_id'] = $person->role_id;
        $data['total_salary'] = ($data['base_salary']+$data['bonus'])-$data['deduction'];
        if ($person) {
            $person->salaries()->create($data);
        }

        return redirect()->route('dashboard.admin.salaries.index')->with('success', 'Salary created successfully.');
    }
    public function edit(Salary $salary)
    {
        $teachers = Teacher::select('id', 'teacher_name')->get();
        $employees = Employee::select('id', 'employee_name')->get();
        $admins = Admin::select('id', 'admin_name')->get();

        $people = [
            'Teacher' => $teachers,
            'Employee' => $employees,
            'Admin' => $admins,
        ];

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.salaries.edit', $sideData , compact('salary', 'people'));
    }
    public function update(Request $request, Salary $salary)
    {
        dd(($request->all()));
        $data = $request->validate([
            'person_id' => 'required|string',
            'base_salary' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:1900|max:2099',
        ]);

        list($personType, $personId) = explode('-', $data['person_id']);

        if ($personType === 'Teacher') {
            $person = Teacher::find($personId);
        } elseif ($personType === 'Admin') {
            $person = Admin::find($personId);
        } else {
            $person = Employee::find($personId);
        }
        $data['role_id'] = $person->role_id;
        $data['person_id'] = $person->id;
        $data['total_salary'] = ($data['base_salary']+$data['bonus'])-$data['deduction'];
        if ($person) {
            $salary->update($data);
        }

        return redirect()->route('dashboard.admin.salaries.index')->with('success', 'Salary updated successfully.');
    }
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->back()->with('success', 'Salary deleted successfully.');
    }
}

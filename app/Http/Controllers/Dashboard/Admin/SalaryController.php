<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\Admin;
use App\Models\Salary;
use App\Models\Teacher;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    use  SideDataTraits;
    public function index(Date $date)
    {
        $teachers = Teacher::select()->get();
        $employees = Employee::select()->get();
        $admins = Admin::select()->get();

        $people = [
            'teacher' => $teachers,
            'employee' => $employees,
            'admin' => $admins,
        ];
        
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.index', $sideData, compact('people', 'date'));
    }
    public function amounts(Date $date)
    {
        $salaries = Salary::where('date_id',$date->id)->with('person')->get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.amounts', $sideData , compact('salaries','date'));
    }
    public function showDates()
    {
        $dates = Date::where('day',null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.dates', $sideData , compact('dates'));
    }
    public function create(Date $date)
    {
        $teachers = Teacher::select('id', 'teacher_name AS name')->get();
        $employees = Employee::select('id', 'employee_name AS name')->get();
        $admins = Admin::select('id', 'admin_name AS name')->get();

        $people = [
            'teacher' => $teachers,
            'employee' => $employees,
            'admin' => $admins,
        ];

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.salaries.create', $sideData , compact(['people','date']));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|string',
            'date_id' => 'required|numeric',
            'amount' => 'nullable|numeric',
        ]);

        list($personType, $personId) = explode('-', $data['person_id']);
        if ($personType === 'teacher') {
            $person = Teacher::find($personId);
        } elseif ($personType === 'admin') {
            $person = Admin::find($personId);
        } else {
            $person = Employee::find($personId);
        }
        if ($person) {
            $person->salaries()->create($data);
        }
        return redirect()->route('dashboard.admin.salaries.index',$data['date_id'])->with('success', 'Salary created successfully.');
    }
    public function edit(Salary $salary)
    {
        $teachers = Teacher::select('id', 'teacher_name AS name')->get();
        $employees = Employee::select('id', 'employee_name AS name')->get();
        $admins = Admin::select('id', 'admin_name AS name')->get();
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
            'date_id' => 'required|numeric',
            'amount' => 'nullable|numeric',
        ]);

        list($personType, $personId) = explode('-', $data['person_id']);
        array_push($person,'name');
        if ($personType === 'Teacher') {
            $person = Teacher::find($personId);
        } elseif ($personType === 'Admin') {
            $person = Admin::find($personId);
        } else {
            $person = Employee::find($personId);
        }
        if ($person) {
            $salary->update($data);
        }

        return redirect()->route('dashboard.admin.salaries.index',$data['date_id'])->with('success', 'Salary updated successfully.');
    }
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->back()->with('success', 'Salary deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\User;
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
        $teachers = User::where('type','teacher')->get();
        $admins =  User::where('type','admin')->get();
        $people = [
            'teacher' => $teachers,
            'admin' => $admins,
        ];

        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.index', $sideData, compact('people', 'date'));
    }
    public function amounts(Date $date)
    {
        $salaries = Salary::where('date_id', $date->id)->with('person')->orderBy('id','desc')->get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.amounts', $sideData, compact('salaries', 'date'));
    }
    public function showDates()
    {
        $dates = Date::where('day', null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.salaries.dates', $sideData, compact('dates'));
    }
    public function create(Date $date, $personId)
    {
        $teachers = User::where('type','teacher')->get();
        $admins =  User::where('type','admin')->get();
        $people = [
            'Teacher' => $teachers,
            'Admin' => $admins,
        ];
        foreach ($people as $type => $persons) {
            foreach ($persons as $person) {
                $user=$person->where('id',$personId)->first();
                if($user){
                $user['type']=$type;
            }
            }
        }
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.salaries.create', $sideData, compact(['people', 'date','user']));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|string',
            'date_id' => 'required|numeric',
            'amount' => 'nullable|numeric',
        ]);

        list($personType,$personId) = explode('-', $data['person_id']);
            $person = User::find($personId);
        if ($person) {
            $person->salaries()->create($data);
        }
        return redirect()->route('dashboard.admin.salaries.amounts', $data['date_id'])->with('success', 'Amount created successfully.');
    }
    public function edit(Salary $salary)
    {
        $teachers = User::where('type','teacher')->get();
        $admins =  User::where('type','admin')->get();
        $people = [
            'Teacher' => $teachers,
            'Admin' => $admins,
        ];
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.salaries.edit', $sideData, compact('salary', 'people'));
    }
    public function update(Request $request, Salary $salary)
    {
        $data = $request->validate([
            'person_id' => 'required|string',
            'date_id' => 'required|numeric',
            'amount' => 'nullable|numeric',
        ]);

        list($personType, $personId) = explode('-', $data['person_id']);
        $data['person_id']=$personId;
        $person = User::find($personId);
            if ($person) {
            $salary->update($data);
        }

        return redirect()->route('dashboard.admin.salaries.amounts', $data['date_id'])->with('success', 'Amount updated successfully.');
    }
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->back()->with('success', 'Amount deleted successfully.');
    }
}
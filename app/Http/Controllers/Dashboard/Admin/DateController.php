<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Date;
use App\Models\Salary;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;

class DateController extends Controller
{
   use SideDataTraits;
   public function create($bage)
   {
      $sideData = $this->getSideData();
      return view('web.dashboard.admin.dates.create', $sideData, compact('bage'));
   }
   public function edit(Date $date)
   {
      $sideData = $this->getSideData();
      return view('web.dashboard.admin.dates.edit', $sideData, compact('date'));
   }
   public function update(Request $request, Date $date)
   {
      $data = $request->validate([
         'day' => 'nullable|numeric',
         'month' => 'required|numeric',
         'year' => 'required|numeric',
      ]);
      Date::where('id', $date->id)->update($data);
      return redirect()->route('dashboard.admin.salaries.show.dates')->with('success', 'date updated successfully!');
   }
   public function store(Request $request, $bage)
   {
      if ($bage == 'salary') {
         $route = 'dashboard.admin.salaries.show.dates';
      } elseif ($bage == 'student_attend') {
         $route = 'dashboard.admin.salaries.show.dates';
      }
      $data = $request->validate([
         'day' => 'nullable|numeric',
         'month' => 'required|numeric',
         'year' => 'required|numeric',
      ]);
      Date::create($data);
      return redirect()->route($route)->with('success', 'date added successfully!');
   }
}
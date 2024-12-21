<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\ClassRoom;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use  SideDataTraits;

    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        abort_if(!(Gate::allows('isAdmin') || Gate::allows('isManager')|| Gate::allows('isHR')|| Gate::allows('isAcademicAffairs')),403) ;
        session()->put('allowdFromAdmin', 1);

        session()->put('academic_year',AcademicYear::orderBy('id','DESC')->first());
            $totalStudents=Student::count();
            $totalTeachers=Teacher::count();
            $totalEmployees=Employee::count();
            $totalUsers=User::count();

            if(session('academic_year'))
            {
                $totalPaied=Payment::where('academic_year_id',session('academic_year')['id'])->sum('total');
            }else{
                $totalPaied = 0;
            }
      
            $totalAmounts=Level::sum('amount');
            $amountsRemaining=$totalAmounts-$totalPaied;
            $data=['totalEmployees'=>$totalEmployees
            ,'totalStudents'=>$totalStudents
            ,'totalTeachers'=>$totalTeachers
            ,'totalUsers'=>$totalUsers
            ,'totalPaied'=>$totalPaied
            ,'amountsRemaining'=>$amountsRemaining
            ];
            $sideData = $this->getSideData();
            return view('web.dashboard.admin.home.index',$sideData,$data);
    }
}
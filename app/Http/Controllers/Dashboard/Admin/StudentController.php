<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\ClassRoom;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    use SideDataTraits;
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()->with(['student','student.classRoom','image'])->where('type', 'student');
        if ($request->has('name') && $request->name != '') {
            $words = explode(' ', trim($request->name));
            $query->where('first_name', 'like', '%' . ($words[0])??''. '%')
                ->where('last_name', 'like', '%' .count($words)>1?$words[1]:'' . '%')
                ->get();
        }
        if ($request->has('class_room_id') && $request->class_room_id != '') {
            $class_room = $request->class_room_id;
            $query->whereHas('student', function ($query) use ($class_room) {
                $query->where('class_room_id', $class_room);
            })->get();
        }
            if ($request->has('sort_by') && in_array($request->sort_by, ['first_name', 'email', 'phone'])) {

            $query->orderBy($request->sort_by, $request->order ?? 'asc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $students = $query->paginate(10);

        $class_rooms = ClassRoom::all();

        $sideData = $this->getSideData();
        return view('web.dashboard.admin.students.index', $sideData, compact('students', 'class_rooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        $role = Role::where('role_name', 'student')->first();
        $class_rooms = ClassRoom::get();
        $guardians = Guardian::get()->all();
        $sideData = $this->getSideData();

        // dd($academicYear->id);
        return view('web.dashboard.admin.students.create', $sideData, compact(['class_rooms', 'role', 'guardians', 'academicYear']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        $user=$this->createUser( $request,$data);
        $studentdata = [
            'guardian_id' => $request['guardian_id'],
            'user_id' => $user['id'],
            'class_room_id' => $request['class_room_id'],
            'relation'=>$data['relation'],
            'start_academic_year_id'=>$request['start_academic_year_id'],
            'created_at' => now(),
        ];
        Student::create($studentdata);
        return redirect()->back()->with('success', 'Student added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        $class_rooms = ClassRoom::get();
        $role = Role::where('for',  'students')->first();
        $guardians = Guardian::get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.students.edit', $sideData, compact(['student', 'class_rooms', 'guardians', 'role']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $user = $student->user;
        $data = $this->updateUser($request, $user);
        $studentdata = [
            'guardian_id' => $data['guardian_id'],
            'user_id' => $user['id'],
            'class_room_id' => $data['class_room_id'],
            'relation'=>$data['relation'],
            'start_academic_year_id'=>$data['start_academic_year_id'],
            'created_at' => now(),
        ];
        $student->update($studentdata);
        return redirect()->route('dashboard.admin.students.index')->with('success', $data['type'] . ' added successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $user = $student->user;
            if ($student) {
                $student->delete();
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'This User cannot be deleted');
        }
    }
    
}
<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\course;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Traits\UserTrait;
use App\Enums\SubjectsEnum;
use Illuminate\Support\Arr;
use App\Enums\UserTypesEnum;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TeacherRequest;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    use SideDataTraits;
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(10);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.teachers.index', $sideData, compact('teachers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = SubjectsEnum::all();
        $roles = Role::where('for', 'teachers')->get();
        $class_rooms = ClassRoom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.teachers.create', $sideData, compact(['subjects', 'roles', 'class_rooms']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $user=$this->createUser( $request,$data);  
        $teacherdata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'experience' => $data['experience'],
            'subject_id' => $data['subject_id'],
            'created_at' => now(),
        ];
        $teacherdata['user_id'] = $user->id;
        Teacher::create($teacherdata);
        return redirect()->back()->with('success',  'Teacher added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $subjects = SubjectsEnum::all();
        $roles = Role::get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.teachers.edit', $sideData, compact('teacher', "roles", 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $user=$teacher->user; 
        $data=$this->updateUser($request,$user);
        $teacherdata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'experience' => $data['experience'],
            'subject_id' => $data['subject_id'],
            'created_at' => now(),
        ];
        $teacher->update($teacherdata);
        return redirect()->route('dashboard.admin.teachers.index')->with('success',  'Teacher added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $user = $teacher->user;
            if ($teacher) {
                $teacher->delete();
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
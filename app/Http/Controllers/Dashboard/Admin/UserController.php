<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Traits\UserTrait;
use App\Enums\SubjectsEnum;
use Illuminate\Support\Arr;
use App\Enums\UserTypesEnum;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use SideDataTraits;
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.users.index', $sideData, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = UserTypesEnum::all();
        $subjects = SubjectsEnum::all();
        $roles = Role::get()->all();
        $class_rooms = Classroom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.users.create', $sideData, compact("roles", 'class_rooms', 'subjects', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validate=$request->validate([
            'email'=>
            'required|email|unique:users,email',
            'salary'=>'required|numeric',

        ]);
        $data = $request->validated();
        $data['email']=$validate['email'];
        $user=$this->createUser( $request,$data);
        if ($data['type'] == 'admin') {
            $admindata = [
                'salary'=>$validate['salary'],
                'created_at' => now(),
                'role_id' => $data['role_id'],
            ];
            $admindata['user_id'] = $user->id;
            Admin::create($admindata);
        } elseif ($data['type'] == 'teacher') {
            $teacherdata = [
                'salary'=>$validate['salary'],
                'role_id' => $data['role_id'],
                'experience' => $data['experience'],
                'subject_id' => $data['subject_id'],
                'created_at' => now(),
            ];
            $teacherdata['user_id'] = $user->id;
            Teacher::create($teacherdata);
        } elseif ($data['type'] == 'student') {
            $studentdata = [
                'role_id' => $data['role_id'],
                'class_room_id' => $data['class_room_id'],
                'created_at' => now(),
            ];
            $studentdata['user_id'] = $user->id;
            Student::create($studentdata);
        }
        return redirect()->route('dashboard.admin.users.index')->with('success', $data['type'] . ' added successfully');
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
    public function edit(User $user)
    {
        // return redirect()->route('dashboard.admin.'.$user->type.'s.edit',$user.'->'.$user->type.'->id');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UserRequest $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if ($user->type == 'admin') {
                $admin = Admin::find($user->id, 'user_id');
                if ($admin) {
                    $admin->delete();
                }
            } elseif ($user->type == 'teacher') {
                $teacher = Teacher::find($user->id, 'user_id');
                if ($teacher) {
                    $teacher->delete();
                }
            } elseif ($user->type == 'student') {
                $student = Student::find($user->id, 'user_id');
                if ($student) {
                    $student->delete();
                }
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'This User cannot be deleted');
        }
    }
}

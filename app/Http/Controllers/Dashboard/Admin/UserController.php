<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
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
        $classrooms = Classroom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.users.create', $sideData, compact("roles", 'classrooms', 'subjects', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $filename = $image->store('/teachers', 'public');
        //     $data['image'] = $filename;
        // }
        $userData = Arr::only($data, [
            'first_name',
            'last_name',
            'email',
            "phone",
            'type',
            "password",
            "role_id",
        ]);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $user->imageable()->create([
                'path' => $filename,
            ]);
        }
        if ($data['type'] == 'admin') {
            $admindata = [
                'created_at' => now(),
                'role_id' => $data['role_id'],
            ];
            $admindata['user_id'] = $user->id;
            Admin::create($admindata);
        } elseif ($data['type'] == 'teacher') {
            $teacherdata = [
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
                'classroom_id' => $data['classroom_id'],
                'created_at' => now(),
            ];
            $studentdata['user_id'] = $user->id;
            Student::create($studentdata);
        }
        return redirect()->back()->with('success', $data['type'] . ' added successfully');
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
        $types = UserTypesEnum::all();
        $subjects = SubjectsEnum::all();
        $roles = Role::get()->all();
        $classrooms = Classroom::get();
        $sideData = $this->getSideData();
        if ($user->type == 'teacher') {
            $teacher = Teacher::find($user->id, 'user_id');
            $student = [];
        } elseif ($user->type == 'student') {
            $student = Student::find($user->id, 'user_id');
            $teacher = [];
        } else {
            $student = [];
            $teacher = [];
        }
        return view('web.dashboard.admin.users.edit', $sideData, compact('user', "roles", 'classrooms', 'subjects', 'types', 'teacher', 'student'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UserRequest $request)
    {

        $data = $request->validated();
        $userData = Arr::only($data, [
            'first_name',
            'last_name',
            'email',
            "phone",
            'type',
            "password",
            "role_id",
        ]);
        if ($userData['password'] == $user->password) {
            $userData['password'] = $user->password;
        } else {
            $userData['password'] = Hash::make($data['password']);
        }
        if ($request->hasFile('image')) {
            if ($user->imageable) {
                Storage::disk('public')->delete($user->imageable->path);
                $user->image->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $user->image()->create([
                'name'=>$user->first_name,
                'path' => $filename,
            ]);
        }
        $user->update($userData);
        if ($data['type'] == 'admin') {
            $admindata = [
                'created_at' => now(),
                'role_id' => $data['role_id'],
            ];
            Admin::where('id', $user->id)->update($admindata);
        } elseif ($data['type'] == 'teacher') {
            $teacherdata = [
                'role_id' => $data['role_id'],
                'experience' => $data['experience'],
                'subject_id' => $data['subject_id'],
                'created_at' => now(),
            ];
            Teacher::where('id', $user->id)->update($teacherdata);
        } elseif ($data['type'] == 'student') {
            $studentdata = [
                // 'role_id' => $data['role_id'],
                'classroom_id' => $data['classroom_id'],
                'created_at' => now(),
            ];
            Student::where('id', $user->id)->update($studentdata);
        }
        return redirect()->route('dashboard.admin.' . $user->role->for . '.index')->with('success', $data['type'] . ' added successfully');
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
            if ($user->imageable) {
                Storage::disk('public')->delete($user->imageable->path);
                $user->imageable->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'This User cannot be deleted');
        }
    }
}
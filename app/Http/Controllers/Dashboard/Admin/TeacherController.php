<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\course;
use App\Models\Teacher;
use Illuminate\Support\Arr;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where('type','teacher')->orderBy('id', 'desc')->paginate(10);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.teachers.index', $sideData , compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=Role::where('for',  'teachers')->first();
        $roles=Role::where('for',  'teachers')->get();

        if(!isset($role))
            return redirect()->back()->with('error','Not Found Role To Create Teacher');

        $course = Course::get()->first();
        $courses = Course::get()->all();

        if(!isset($course))
            return redirect()->back()->with('error','Not Found Course To Create Teacher');

            $sideData = $this->getSideData();

        return view('web.dashboard.admin.teachers.create', $sideData , compact(['courses', 'course', 'roles','role']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {

        $data = $request->validated();

        $userData = [
            'name' => $data['teacher_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
        ];
        $data = Arr::except($data, ['password']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/teachers', 'public');
            $data['image'] = $filename;
        }
        $user = User::create($userData);
        $data['user_id'] = $user->id;
        Teacher::create($data);
        return redirect()->route('dashboard.admin.teachers.index')->with('success', 'teacher added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $roles=Role::where('for',  'teachers')->get();
        // dd($teacher);
        $courses = Course::get()->all();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.teachers.edit', $sideData ,compact(['courses', 'teacher', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        $userData = [
            'name' => $data['teacher_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ];
        if ($data['password'] == $teacher->user->password) {
            $userData['password'] = $teacher->user->password;
        } else {
            $userData['password'] = $data['password'];
        }

        if ($request->hasFile('image')) {
            if ($teacher->image) {
                Storage::disk('public')->delete($teacher->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/teachers', 'public');
            $data['image'] = $filename;
        }
        $data = Arr::except($data, ['password','role_id']);
        User::where('id', $teacher->user_id)->update($userData);
        Teacher::where('id', $teacher->id)->update($data);
        return redirect()->route('dashboard.admin.teachers.index')->with('success', 'teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $user = User::find($teacher->user_id);
        $imagePath = $teacher->image ?? null;

        try {
            DB::beginTransaction();

            $teacher->delete();

            if ($user) {
                $user->delete();
            }

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Teacher deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('errors', 'This teacher cannot be deleted');
        }
    }

}

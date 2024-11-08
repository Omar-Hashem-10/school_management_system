<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\course;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(10);
        return view('web.dashboard.admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = Course::get()->first();
        $courses = Course::get()->all();
        return view('web.dashboard.admin.teachers.create', compact(['courses', 'course']));
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
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'created_at' => now(),
        ];
        $data = Arr::except($data, ['password', 'role_id']);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $courses = Course::get()->all();
        return view('web.dashboard.admin.teachers.edit',compact(['courses', 'teacher']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        // abort_if(!Gate::allows('admin'),403);
        // dd($request->all());
        $data = $request->validated();
        $userData = [
            'name' => $data['teacher_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'updated_at' => now(),
        ];
        if ($data['password'] == $teacher->user->password) {
            $userData['password'] = $teacher->user->password;
        } else {
            $userData['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('image')) {
            if ($teacher->image) {
                Storage::disk('public')->delete($teacher->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/teachers', 'public');
            $data['image'] = $filename;
        }
        $data = Arr::except($data, 'password');
        User::where('id', $teacher->user_id)->update($userData);
        Teacher::where('id', $teacher->id)->update($data);
        return redirect()->route('dashboard.admin.teachers.index')->with('success', 'teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $user= User::where('id',$teacher->user_id)->find;
        $imagePath = null;
        if ($teacher->image) {
            $imagePath = $teacher->image;
        }
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
            return redirect()->back()->with('success', 'teacher deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This teacher can not be deleted');
        }
    }
}

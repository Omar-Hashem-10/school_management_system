<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(10);
        return view('web.dashboard.admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class=ClassRoom::first();
        $classes=ClassRoom::get();
        return view('web.dashboard.admin.students.create',compact(['classes','class']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {

        $data = $request->validated();
        $userData = [
            'name' => $data['student_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'created_at' => now(),
        ];
        $data = Arr::except($data, ['password', 'role_id']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/students', 'public');
            $data['image'] = $filename;
        }
        $user = User::create($userData);
        $data['user_id'] = $user->id;
        student::create($data);
        return redirect()->route('dashboard.admin.students.index')->with('success', 'student added successfully');
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
    public function edit(student $student)
    {
        $classes=ClassRoom::get();
        return view('web.dashboard.admin.students.edit',compact(['student','classes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        // abort_if(!Gate::allows('admin'),403);
        // dd($request->all());
        $data = $request->validated();
        $userData = [
            'name' => $data['student_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'updated_at' => now(),
        ];
        if ($data['password'] == $student->user->password) {
            $userData['password'] = $student->user->password;
        } else {
            $userData['password'] = Hash::make($data['password']);
        }
        $data = Arr::except($data, ['password', 'role_id']);
        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/students', 'public');
            $data['image'] = $filename;
        }
        $data = Arr::except($data, 'password');
        User::where('id', $student->user_id)->update($userData);
        student::where('id', $student->id)->update($data);
        return redirect()->route('dashboard.admin.students.index')->with('success', 'student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $user=User::find($student->user_id);
        $imagePath = null;
        if ($student->image) {
            $imagePath = $student->image;
        }
        try {
            DB::beginTransaction();
            $student->delete();
            if ($user) {
                $user->delete();
            }
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            DB::commit();
            return redirect()->back()->with('success', 'student deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This student can not be deleted');
        }
    }
}
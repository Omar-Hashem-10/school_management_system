<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()->where('type','student');

        if ($request->has('student_name') && $request->student_name != '') {
            $query->where('student_name', 'like', '%' . $request->student_name . '%');
        }

        if ($request->has('class_room_id') && $request->class_room_id != '') {
            $query->where('class_room_id', $request->class_room_id);
        }

        if ($request->has('sort_by') && in_array($request->sort_by, ['student_name', 'email', 'phone'])) {
            $query->orderBy($request->sort_by, $request->order ?? 'asc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $students = $query->paginate(10);

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.students.index', $sideData , compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class=ClassRoom::first();
        $classes=ClassRoom::get();

        if(!isset($class))
        return redirect()->back()->with('error','Not Found Class To Create Student');

        $role=Role::where('for',  'students')->first();
        $roles=Role::where('for',  'students')->get();

        if(!isset($role))
        return redirect()->back()->with('error','Not Found Role To Create Student');

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.students.create', $sideData ,compact(['classes','class','roles', 'role']));
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
            'password' => $data['password'],
            'role_id' => $data['role_id'],
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
        return redirect()->route('dashboard.admin.students.create')->with('success', 'student added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        $classes=ClassRoom::get();
        $role=Role::where('for',  'students')->first();
        $roles=Role::where('for',  'students')->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.students.edit', $sideData ,compact(['student','classes','roles','role']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();
        $userData = [
            'name' => $data['student_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ];
        if ($data['password'] == $student->user->password) {
            $userData['password'] = $student->user->password;
        } else {
            $userData['password'] = $data['password'];
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
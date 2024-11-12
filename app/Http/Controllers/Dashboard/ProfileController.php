<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Employee;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use DataTraits;
    public function index()
    {
        $sideData = $this->getSideData();
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            $this->getProfileData(Admin::class);
        } elseif (Gate::allows('isTeacher')) {
            $this->getProfileData(Teacher::class);
        } elseif (Gate::allows('isStudent')) {
            $this->getProfileData(Student::class);
        }else{
            $this->getProfileData(Employee::class);
        }
        return view('web.dashboard.profile.index', $sideData);
    }
    public function updateImage(Request $request, string $id)
    {

        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            $person = Admin::findOrFail($id);
        } elseif (Gate::allows('isTeacher')) {
            $person = Teacher::findOrFail($id);
        } elseif (Gate::allows('isStudent')) {
            $person = Student::findOrFail($id);
        }else{
            $person = Employee::findOrFail($id);
        }
        // dd($person,$model);
        if ($request->hasFile('image')) {
            if ($person->image) {
                Storage::disk('public')->delete($person->image);
            }
            $image = $request->file('image');
            if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
                $filename = $image->store('/admins', 'public');
            } elseif (Gate::allows('isTeacher')) {
                $filename = $image->store('/teachers', 'public');
            } elseif (Gate::allows('isStudent')) {
                $filename = $image->store('/students', 'public');
            }else{
                $filename = $image->store('/employees', 'public');
            }

            $data['image'] = $filename;
        }
        $person->image = $data['image'];
        $person->save();
        session('user')[0]['image'] = $person->image;
        return redirect()->route('dashboard.profile.index')->with('success', 'image updated successfully');
    }
    public function destroyImage($id)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            $person = Admin::findOrFail($id);
        } elseif (Gate::allows('isTeacher')) {
            $person = Teacher::findOrFail($id);
        } elseif (Gate::allows('isStudent')) {
            $person = Student::findOrFail($id);
        }else{
            $person = Employee::findOrFail($id);
        }
        if ($person->image) {
            Storage::disk('public')->delete($person->image);
        }
        $person->image = null;
        $person->save();
        session('user')[0]['image'] = $person->image;
        
        return redirect()->back()->with('success', 'image deleted successfully');
    }
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'nullable|string',
            'email'=>'required|email|max:255',
        ]);
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            $person = Admin::findOrFail($id);
            $data['admin_name']=$data['name'];
        } elseif (Gate::allows('isTeacher')) {
            $person = Teacher::findOrFail($id);
            $data['teacher_name']=$data['name'];
        } elseif (Gate::allows('isStudent')) {
            $person = Student::findOrFail($id);
            $data['student_name']=$data['name'];
        }else{
            $person = Employee::findOrFail($id);
            $data['employee_name']=$data['name'];
        }
        session('user')[0]['name'] = $data['name'];
        unset($data['name']);
        foreach($data as $key => $value){
            $person[$key]=$value;
            session('user')[0][$key] = $person[$key];
        }
        $person->save();
        User::where('id',$person->user_id)->update($userData);
        return redirect()->back()->with('success', 'the data updated successfully');
    }
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'currentPassword'=>['required',
            function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail('The Current password is not correct.');
                }
            },
        ],
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);
        $data=['password'=>Hash::make($request->password)];
        User::where('id', $user->id)->update($data);
        return redirect()->back()->with('success', 'the password updated successfully');
    }
}
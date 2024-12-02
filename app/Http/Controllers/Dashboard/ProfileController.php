<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\Guardian;
use App\Traits\DataTraits;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\ProfilePasswordRequest;

class ProfileController extends Controller
{
    use DataTraits ,SideDataTraits;

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
            $this->getProfileData(Guardian::class);
        }
        return view('web.dashboard.profile.index', $sideData);
    }
    public function updateImage(ProfileImageRequest $request, string $id)
    {

        $user=Auth::user();
        
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image->path);
                $user->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            if (!$user) {
                return back()->with('error', 'User not found');
            }
            $user->image()->create([
                'path' => $filename,
            ]);
        }
        return redirect()->route('dashboard.profile.index')->with('success', 'image updated successfully');
    }
    public function destroyImage($id)
    {
        $user=Auth::user();
        if ($user->image) {
            Storage::delete('public/' . $user->image->path);
            $user->image()->delete();
        }
        return redirect()->back()->with('success', 'image deleted successfully');
    }
    public function update(ProfileRequest $request,$id)
    {
        $data=$request->validated();
        // dd($data);
        // $data=Arr::except($data,'image');
        try{
        $user=Auth::user();
        $user->update($data);
    }catch(Exception $e){
        return redirect()->back()->with('error','the email is exist before');
}
        return redirect()->back()->with('success', 'the data updated successfully');
    }
    public function changePassword(ProfilePasswordRequest $request, User $user)
    {
        
        $data=['password'=>Hash::make($request->password)];
        User::where('id', $user->id)->update($data);
        return redirect()->back()->with('success', 'the password updated successfully');
    }
}
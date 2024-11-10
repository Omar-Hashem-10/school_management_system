<?php


namespace App\Traits;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait DataTraits
{
    public function getSideData()
    {
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');
        $classRooms = ClassRoom::get();
        return compact(['class_room_names','course_codes','classRooms']);
    }
    public function getProfileData($model){
        $user=$model::where('user_id',operator: auth()->user()->id)->first();
        abort_if(!$user,404);
        if(Gate::allows('isAdmin')||Gate::allows('isMAnager')){
            $user['name']=$user->admin_name;
        }elseif(Gate::allows('isTeacher')){
            $user['name']=$user->teacher_name;
        }
        elseif(Gate::allows('isStudent')){
            $user['name']=$user->student_name;
        }
        session()->push('user',$user);
        return compact('user');
    }
    public function storeImage($request,$person){
            $image = $request->file('image');
            $filename = $image->store('/'.$person.'s', 'public');
            $data['image'] = $filename;
            
    }
    public function destroyImage($person){
            if ($person->image) {
                Storage::disk('public')->delete($person->image);
            }
    }
    
}
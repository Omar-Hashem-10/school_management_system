<?php


namespace App\Traits;

use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait DataTraits
{
    public function getProfileData($model){
        $user=User::where('id',operator: auth()->user()->id)->first();
        abort_if(!$user,404);
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
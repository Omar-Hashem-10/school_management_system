<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Teacher;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$teachers->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $user=$this->createUser( $request,$data);
        $teacherdata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'experience' => $data['experience'],
            'subject_id' => $data['subject_id'],
            'created_at' => now(),
        ];
        $teacherdata['user_id'] = $user->id;
        $teacher=Teacher::create($teacherdata);
        return $this->responseSuccess('Added Successfully!',$teacher->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $user=$teacher->user;
        return $this->responseSuccess('Data Retrieved Successfully!',$teacher->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $user=$teacher->user;
        $data=$this->updateUser($request,$user);
        $teacherdata = [
            'role_id' => $data['role_id'],
            'salary' => $data['salary'],
            'experience' => $data['experience'],
            'subject_id' => $data['subject_id'],
            'created_at' => now(),
        ];
        $teacher->update($teacherdata);
        return $this->responseSuccess('Updated Successfully!',$teacher->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $user = $teacher->user;
            if ($teacher) {
                $teacher->delete();
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image->delete();
            }
            $user->delete();
            return $this->responseSuccess('Deleted Successfully!');
        } catch (Exception $e) {
            return $this->responseFailure("Cannot Delete This Teacher",404);
        }
    }
}
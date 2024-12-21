<?php


namespace App\Http\Controllers\Api\Admin;

use App\Models\Student;
use App\Traits\UserTrait;
use Exception;
use App\Models\Grade;
use App\Models\Attend;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $students = Student::with(['user', 'guardian'])->orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!', $students->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        $user=$this->createUser( $request,$data);
        $studentdata = [
            'guardian_id' => $request['guardian_id'],
            'user_id' => $user['id'],
            'class_room_id' => $request['class_room_id'],
            'relation'=>$data['relation'],
            'created_at' => now(),
        ];
        $student=Student::create($studentdata);
        return $this->responseSuccess('Added Successfully!',$student->toArray());
    }



    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $grades = Grade::where('student_id', $student->id)->get();

        $attendanse = Attend::where('attendable_id', $student->user->id)->get();

        $data = [
            'grades' => $grades->toArray(),
            'attendance' => $attendanse->toArray(),
        ];

        return $this->responseSuccess('Data Retrieved Successfully!', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $user = $student->user;
        $data = $this->updateUser($request, $user);
        $studentdata = [
            'guardian_id' => $data['guardian_id'],
            'user_id' => $user['id'],
            'class_room_id' => $data['class_room_id'],
            'relation'=>$data['relation'],
            'created_at' => now(),
        ];
        $student->update($studentdata);
        return $this->responseSuccess('Updated Successfully!',$student->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $user = $student->user;
            if ($student) {
                $student->delete();
            }
            if ($user->image) {
                Storage::disk('public')->delete($user->image?->path);
                $user->image->delete();
            }
            $user->delete();
            return $this->responseSuccess('Deleted Successfully!');
        } catch (Exception $e) {
            return $this->responseFailure("Cannot Delete This Student",404);
        }
    }
}
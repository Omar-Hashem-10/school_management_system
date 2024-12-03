<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\CourseCode;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTeacherRequest;

class CourseTeacherController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacherId = $request->query('teacher_id');

        if (!$teacherId) {
            return $this->responseFailure('Teacher ID is required', 400);
        }

        $teacher = Teacher::find($teacherId);

        if (!$teacher) {
            return $this->responseFailure('Teacher not found', 404);
        }

        $courseCodes = $teacher->courseCodes;

        if ($courseCodes->isEmpty()) {
            return $this->responseFailure('No courses found for this teacher', 404);
        }

        return $this->responseSuccess('Courses found successfully', $courseCodes->toArray());
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(CourseTeacherRequest $request)
    {
        $validated = $request->validated();

        $course_code = CourseCode::find($validated['course_code_id']);
        $teacher = Teacher::find($validated['teacher_id']);
        $classRoom = ClassRoom::find($validated['class_room_id']);

        if (!$course_code || !$teacher || !$classRoom) {
            return $this->responseFailure('Course, Teacher, or ClassRoom not found', 404);
        }

        $course_code->teachers()->attach($teacher->id, ['class_room_id' => $classRoom->id]);

        return $this->responseSuccess(
            'Teacher assigned to the course code successfully',
            [
                'course_code' => $course_code->code,
                'teacher' => $teacher->user->first_name,
                'class_room' => $classRoom->name
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course_teacher = DB::table('course_teachers')
                            ->where('id', $id)
                            ->first();

            if (!$course_teacher) {
            return $this->responseFailure('Course teacher record not found', 404);
        }

        $course_code = CourseCode::find($course_teacher->course_code_id);
        $teacher = Teacher::find($course_teacher->teacher_id);
        $classRoom = ClassRoom::find($course_teacher->class_room_id);

        $data = [
            'id' => $course_teacher->id,
            'course_code' => $course_code,
            'teacher' => $teacher,
            'class_room' => $classRoom,
        ];

        return $this->responseSuccess('Course teacher record retrieved successfully', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CourseTeacherRequest $request, string $id)
    {
        $course_teacher = DB::table('course_teachers')->where('id', $id)->first();

        if (!$course_teacher) {
            return $this->responseFailure('Course teacher record not found', 404);
        }

        $validated = $request->validated();

        DB::table('course_teachers')
            ->where('id', $id)
            ->update([
                'course_code_id' => $validated['course_code_id'],
                'teacher_id' => $validated['teacher_id'],
                'class_room_id' => $validated['class_room_id'],
            ]);

        $updated_course_teacher = DB::table('course_teachers')->where('id', $id)->first();

        $course_code = CourseCode::find($updated_course_teacher->course_code_id);
        $teacher = Teacher::find($updated_course_teacher->teacher_id);
        $classRoom = ClassRoom::find($updated_course_teacher->class_room_id);

        return $this->responseSuccess(
            'Course teacher record updated successfully',
            [
                'course_code' => $course_code->code,
                'teacher' => $teacher->user->first_name,
                'class_room' => $classRoom->name
            ]
        );
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course_teacher = DB::table('course_teachers')->where('id', $id)->first();

        if (!$course_teacher) {
            return $this->responseFailure('Course teacher record not found', 404);
        }

        DB::table('course_teachers')->where('id', $id)->delete();

        return $this->responseSuccess('Course teacher record deleted successfully');
    }

}

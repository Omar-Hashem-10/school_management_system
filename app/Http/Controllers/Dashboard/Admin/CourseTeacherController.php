<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\CourseCode;
use App\Traits\DataTraits;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\HelperFunctionsTrait;
use App\Http\Requests\CourseTeacherRequest;

class CourseTeacherController extends Controller
{
    use DataTraits, SideDataTraits, HelperFunctionsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);


        if (!$teacher) {
            return redirect()->route('dashboard.admin.teachers.index')->with('error', 'Teacher not found');
        }

        session()->put('teacher_id', $teacher_id);
        session()->put('subject_id', $teacher->subject_id);

        $course_teachers = $teacher->courseCodes()
            ->with(['classRooms', 'teachers'])
            ->get();


        $sideData = $this->getSideData();

        return view('web.dashboard.admin.course_teachers.index', array_merge($sideData, ['course_teachers' => $course_teachers]));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::with('levels')->get();
        $course_codes = CourseCode::get();
        $class_rooms = ClassRoom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_teachers.create', array_merge($sideData, ['course_codes' => $course_codes], ['class_rooms' => $class_rooms], ['subjects' => $subjects]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseTeacherRequest $request)
    {
        $teacher = Teacher::find($request->input('teacher_id'));
        $courseCode = CourseCode::find($request->input('course_code_id'));
        $classRoom = ClassRoom::find($request->input('class_room_id'));

        if (!$teacher || !$courseCode || !$classRoom) {
            return $this->redirectWithError('dashboard.admin.course_teachers.create', 'Teacher, Course Code, or Class Room not found.');
        }

        if ($teacher->courseCodes()->where('course_code_id', $courseCode->id)
        ->wherePivot('class_room_id', $classRoom->id)
        ->exists()) {
        return $this->redirectWithError('dashboard.admin.course_teachers.create', 'This teacher is already assigned to this course in the same class room.');
        }


        $levelSubjectId = $courseCode->level_subject_id;
        $levelSubject = Level::whereHas('subjects', fn($query) => $query->where('level_subjects.id', $levelSubjectId))
                                ->pluck('id')->first();

        if (!$levelSubject || $levelSubject != $classRoom->level_id) {
            return $this->redirectWithError('dashboard.admin.course_teachers.create', 'Invalid level subject or mismatch with class room level.');
        }

        $teacher->courseCodes()->attach($courseCode->id, ['class_room_id' => $classRoom->id]);

        return redirect()->route('dashboard.admin.course_teachers.create')
                            ->with('success', 'Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course_teacher = DB::table('course_teachers')->where('id', $id)->first();
        $levels = Level::with('subjects')->get();
        $course_codes = CourseCode::get();
        $class_rooms = ClassRoom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_teachers.edit', array_merge($sideData, ['course_codes' => $course_codes], ['class_rooms' => $class_rooms], ['levels' => $levels], ['course_teacher' => $course_teacher]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseTeacherRequest $request, string $id)
    {
        $teacher = Teacher::find($request->input('teacher_id'));
        $courseCode = CourseCode::find($request->input('course_code_id'));
        $classRoom = ClassRoom::find($request->input('class_room_id'));

        if (!$teacher || !$courseCode || !$classRoom) {
            return redirect()->route('dashboard.admin.course_teachers.edit', ['course_teacher' => $id])
                                ->with('error', 'Teacher, Course Code, or Class Room not found.');
        }

        $existingRelation = $teacher->courseCodes()->where('course_code_id', $courseCode->id)->first();

        if ($existingRelation && $existingRelation->pivot->class_room_id == $classRoom->id) {
            return redirect()->route('dashboard.admin.course_teachers.index', ['teacher_id' => $request->teacher_id])
                                ->with('info', 'The course and class room are already assigned to this teacher.');
        }

        $levelSubjectId = $courseCode->level_subject_id;
        $levelSubject = Level::whereHas('subjects', fn($query) => $query->where('level_subjects.id', $levelSubjectId))
                                ->pluck('id')->first();

        if (!$levelSubject || $levelSubject != $classRoom->level_id) {
            return redirect()->route('dashboard.admin.course_teachers.edit', ['course_teacher' => $id])
                                ->with('error', 'Invalid level subject or mismatch with class room level.');
        }

        $teacher->courseCodes()->updateExistingPivot($id, [
            'course_code_id' => $courseCode->id,
            'class_room_id' => $classRoom->id,
        ]);

        return redirect()->route('dashboard.admin.course_teachers.index', ['teacher_id' => $request->teacher_id])
                            ->with('success', 'Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail(session('teacher_id'));

        $teacher->courseCodes()->wherePivot('id', $id)->detach();

        return redirect()->route('dashboard.admin.course_teachers.index', ['teacher_id' => session('teacher_id')])
                            ->with('success', 'Deleted Successfully!');
    }


}

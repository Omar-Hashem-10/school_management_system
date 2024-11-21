<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\CourseCode;
use App\Traits\DataTraits;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTeacherRequest;

class CourseTeacherController extends Controller
{
    use DataTraits, SideDataTraits;
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

        $course_teachers = $teacher->courseCodes()->get();


        $sideData = $this->getSideData();

        return view('web.dashboard.admin.course_teachers.index', array_merge($sideData, ['course_teachers' => $course_teachers]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::with('subjects')->get();
        $course_codes = CourseCode::get();
        $class_rooms = ClassRoom::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_teachers.create', array_merge($sideData, ['course_codes' => $course_codes], ['class_rooms' => $class_rooms], ['levels' => $levels]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseTeacherRequest $request)
    {
        $teacherId = $request->input('teacher_id');
        $courseCodeId = $request->input('course_code_id');
        $classRoomId = $request->input('class_room_id');

        $teacher = Teacher::find($teacherId);

        if (!$teacher) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'Teacher not found.');
        }

        $existingRelation = $teacher->courseCodes()->where('course_code_id', $courseCodeId)->exists();

        if ($existingRelation) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'This teacher is already assigned to this course.');
        }

        $courseCode = CourseCode::find($courseCodeId);

        if (!$courseCode) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'Course code not found.');
        }

        $levelSubjectId = $courseCode->level_subject_id;

        $levelSubject = Level::with(['subjects' => function ($query) use ($levelSubjectId) {
            $query->where('level_subjects.id', $levelSubjectId);
        }])->find($levelSubjectId);


        if (!$levelSubject) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'Level subject not found.');
        }

        $classRoom = ClassRoom::find($classRoomId);

        if (!$classRoom) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'Class room not found.');
        }

        if ($levelSubject->id != $classRoom->level_id) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                                ->with('error', 'The level of the class room does not match the level of the course.');
        }

        $teacher->courseCodes()->attach($courseCodeId, ['class_room_id' => $classRoomId]);

        return redirect()->route('dashboard.admin.course_teachers.create')
                            ->with('success', 'Created Successfully!')
                            ->with('level', $levelSubject);
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
        $teacher = Teacher::findOrFail($request->teacher_id);

        $course_code_id = $request->course_code_id;
        $class_room_id = $request->class_room_id;

        $existingRelation = $teacher->courseCodes()
                                    ->where('course_code_id', $course_code_id)
                                    ->exists();

        if ($existingRelation) {
            return redirect()->back()->with('error', 'This course is already assigned to the teacher.');
        }

        $courseCode = CourseCode::find($course_code_id);

        if (!$courseCode) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                             ->with('error', 'Course code not found.');
        }

        $levelSubjectId = $courseCode->level_subject_id;

        $levelSubject = Level::with(['subjects' => function ($query) use ($levelSubjectId) {
            $query->where('level_subjects.id', $levelSubjectId);
        }])->find($levelSubjectId);

        if (!$levelSubject) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                             ->with('error', 'Level subject not found.');
        }

        $classRoom = ClassRoom::find($class_room_id);

        if (!$classRoom) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                             ->with('error', 'Class room not found.');
        }

        if ($levelSubject->id != $classRoom->level_id) {
            return redirect()->route('dashboard.admin.course_teachers.create')
                             ->with('error', 'The level of the class room does not match the level of the course.');
        }

        $teacher->courseCodes()->updateExistingPivot($id, [
            'course_code_id' => $course_code_id,
            'class_room_id' => $class_room_id,
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

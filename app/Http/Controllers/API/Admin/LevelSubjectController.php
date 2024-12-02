<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelSubjectRequest;

class LevelSubjectController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('levels')->orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$subjects->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelSubjectRequest $request)
    {
        $subject = Subject::find($request->subject_id);

        $level = Level::find($request->level_id);

        $subject->levels()->attach($level->id);

        return $this->responseSuccess('Created Successfully!',$subject->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

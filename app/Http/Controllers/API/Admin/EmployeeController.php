<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Employee;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    use JsonResponseTrait , UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$employees->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data=$request->validated();
        $employee=Employee::create($data);
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete('public/' . $employee->image->path);
                $employee->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $employee->image()->create([
                'path' => $filename,
            ]);
        }
        return $this->responseSuccess('Added Successfully!',$employee->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $this->responseSuccess('Data Retrieved Successfully!',$employee->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data=$request->validated();
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete('public/' . $employee->image->path);
                $employee->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $employee->image()->create([
                'path' => $filename,
            ]);
        }
        $employee->Update($data);
        return $this->responseSuccess('Updated Successfully!',$employee->toArray());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image?->path);
                $employee->image()->delete();
            }
            $employee->delete();
            return $this->responseSuccess('Deleted Successfully!');
        } catch (Exception $e) {
            return $this->responseFailure("Cannot Delete This Teacher",404);
        }
    }
}
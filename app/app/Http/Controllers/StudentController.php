<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Services\Student\StudentService;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('grade')->get();
        return $students->toArray();
    }

    /**
     * @param StudentStoreRequest $request
     * @param StudentService $service
     * @return array
     */
    public function store(StudentStoreRequest $request, StudentService $service)
    {
        return $service->save($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, StudentService $service)
    {
        return $service->getStudentData($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student, StudentService $service)
    {
        return $service->update($request, $student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, StudentService $service)
    {
        return $service->delete($student);
    }
}

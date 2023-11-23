<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\Student;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * @param StudentsRequest $request
     * @return array
     */
    public function store(StudentsRequest $request)
    {
        try {
            $student = new Student();
            $student->fill($request->all());
            $student->save();
            return $student->toArray();
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return $student->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $a= 1;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        if (isset($student->id)) {
            $student->fill($request->all());
            $student->save();
            return $student->toArray();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if (isset($student->id)) {
            $student->delete();
        }
    }
}

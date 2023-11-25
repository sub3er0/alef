<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Grade;
use App\Models\Lecture;
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
     * @param StudentStoreRequest $request
     * @return array
     */
    public function store(StudentStoreRequest $request)
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
    public function show(Request $student)
    {
        /** @var Grade $grade */
        $grade = $student->grade()->first();
        $lecturesData = [];

        if ($grade->id) {
            $lectures = $grade->lecture()?->get();
            /** @var Lecture $lecture */
            foreach ($lectures as $lecture) {
                $lecturesData[] = $lecture->toArray();
            }
        }
        $studentData = $student->toArray();
        $studentData['lectures'] = $lecturesData;
        return $studentData;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        try {
            if (isset($student->id)) {
                $student->fill($request->all());
                $student->save();
                return $student->toArray();
            }
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            if (isset($student->id)) {
                $student->delete();
                return [
                    'result' => true
                ];
            }
        } catch (\Exception $e) {
            return [
                'result' => false,
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

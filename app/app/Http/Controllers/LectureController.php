<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Student;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures = Lecture::all();
        return $lectures->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request)
    {
        try {
            $lecture = new Lecture();
            $lecture->fill($request->all());
            $lecture->save();
            return $lecture->toArray();
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
    public function show(Lecture $lecture)
    {
        try {
            $lectureData = $lecture->toArray();
            $grades = $lecture->grade()?->get();
            $gradesData = [];
            $studentsData = [];
            /** @var Grade $grade */
            foreach ($grades as $grade) {
                $students = $grade->students()?->get();
                /** @var Student $student */
                foreach ($students as $student) {
                    $studentData = $student->toArray();
                    $studentsData[$studentData['id']] = $studentData;
                }
                $gradeData = $grade->toArray();
                $gradesData[$gradeData['id']] = $gradeData;
            }
            $lectureData['grades'] = array_values($gradesData);
            $lectureData['students'] = array_values($studentsData);
            return $lectureData;
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture)
    {
        try {
            if ($lecture->id) {
                $lecture->fill($request->all());
                $lecture->update();
                return $lecture->toArray();
            }
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        try {
            if (isset($lecture->id)) {
                $lecture->delete();
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

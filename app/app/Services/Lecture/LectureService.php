<?php

declare(strict_types=1);

namespace App\Services\Lecture;

use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Student;

/**
 * LectureService
 */
class LectureService
{
    /**
     * @param LectureStoreRequest $request
     * @return Lecture
     */
    public function save(LectureStoreRequest $request): Lecture
    {
        $lecture = new Lecture();
        $lecture->fill($request->all());
        $lecture->save();
        return $lecture;
    }

    /**
     * @param Lecture $lecture
     * @return array
     */
    public function getLectureData(Lecture $lecture): array
    {
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
    }

    /**
     * @param LectureUpdateRequest $request
     * @param Lecture $lecture
     * @return Lecture
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture): Lecture
    {
        $lecture->fill($request->all());
        $lecture->update();
        return $lecture;
    }

    /**
     * @param Lecture $lecture
     * @return array
     */
    public function delete(Lecture $lecture): array
    {
        $lecture->delete();
        return [
            'result' => true
        ];
    }
}

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
     * @return array
     */
    public function save(LectureStoreRequest $request): array
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
     * @param Lecture $lecture
     * @return array
     */
    public function getLectureData(Lecture $lecture): array
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
     * @param LectureUpdateRequest $request
     * @param Lecture $lecture
     * @return array
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture): array
    {
        try {
            if ($lecture->id) {
                $lecture->fill($request->all());
                $lecture->update();
                return $lecture->toArray();
            }
            return ['error' => true, 'message' => 'Нет лекции с заданным id'];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param Lecture $lecture
     * @return array
     */
    public function delete(Lecture $lecture): array
    {
        try {
            if (isset($lecture->id)) {
                $lecture->delete();
                return [
                    'result' => true
                ];
            }
            return ['error' => true, 'message' => 'Нет лекции с заданным id'];
        } catch (\Exception $e) {
            return [
                'result' => false,
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

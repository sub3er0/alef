<?php

declare(strict_types=1);

namespace App\Services\Student;

use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Student;

/**
 * StudentService
 */
class StudentService
{
    /**
     * @param StudentStoreRequest $request
     * @return array
     */
    public function save(StudentStoreRequest $request): array
    {
        try {
            $gradeId = $request->get('grade_id');
            if ($gradeId) {
                $grade = Grade::query()->where('id', $gradeId)->first();
                if (!$grade) {
                    throw new \Exception('Не существует выбранного класса');
                }
            }
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
     * @param Student $student
     * @return array
     */
    public function getStudentData(Student $student): array
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
     * @param StudentUpdateRequest $request
     * @param Student $student
     * @return array|void
     */
    public function update(StudentUpdateRequest $request, Student $student): array
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
     * @param Student $student
     * @return array|true[]|void
     */
    public function delete(Student $student): array
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

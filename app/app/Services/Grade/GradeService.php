<?php

declare(strict_types=1);

namespace App\Http\Services\Grade;

use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

/**
 * GradeService
 */
class GradeService
{
    /**
     * @param GradeStoreRequest $request
     * @return array
     */
    public function save(GradeStoreRequest $request)
    {
        try {
            $grade = new Grade();
            $grade->fill($request->all());
            $grade->save();
            return $grade->toArray();
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param Grade $grade
     * @return array|void
     */
    public function getGradeData(Grade $grade)
    {
        try {
            if ($grade->id) {
                $gradeData = $grade->toArray();
                $gradeData['students'] = $grade->students()->get()->toArray();
                return $gradeData;
            }
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param GradeUpdateRequest $request
     * @param Grade $grade
     * @return array|void
     */
    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        try {
            if (isset($grade->id)) {
                $grade->fill($request->all());
                $grade->save();
                return $grade->toArray();
            }
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param Grade $grade
     * @return array|true[]|void
     */
    public function delete(Grade $grade){
        try {
            if (isset($grade->id)) {
                DB::transaction(function() use ($grade){
                    DB::table('plans')->where('grade_id', $grade->id)->delete();
                    $students = $grade->students()->get();
                    /** @var Student $student */
                    foreach ($students as $student) {
                        $student->grade_id = null;
                        $student->save();
                    }
                    $grade->withoutRelations()->delete();
                }
                );
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

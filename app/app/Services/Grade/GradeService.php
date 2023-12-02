<?php

declare(strict_types=1);

namespace App\Services\Grade;

use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

use function MongoDB\BSON\toJSON;

/**
 * GradeService
 */
class GradeService
{
    /**
     * @param GradeStoreRequest $request
     * @return mixed
     */
    public function save(GradeStoreRequest $request): mixed
    {
        $grade = new Grade();
        $grade->fill($request->all());
        $grade->save();
        return $grade;
    }

    /**
     * @param Grade $grade
     * @return Grade
     */
    public function getGradeData(Grade $grade): Grade
    {
        //$grade->stu = $grade->students()->get()
        return $grade;
    }

    /**
     * @param GradeUpdateRequest $request
     * @param Grade $grade
     * @return JsonResource
     */
    public function update(GradeUpdateRequest $request, Grade $grade): Grade
    {
        $grade->fill($request->all());
        $grade->save();
        return $grade;
    }

    /**
     * @param Grade $grade
     * @return array
     */
    public function delete(Grade $grade): array
    {
        DB::transaction(function() use ($grade){
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
}

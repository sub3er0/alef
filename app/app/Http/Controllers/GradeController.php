<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Grade\LectureStoreRequest;
use App\Http\Requests\Grade\LectureUpdateRequest;
use App\Models\Grade;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Grade::all();
        return $students->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request)
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
     * Display the specified resource.
     */
    public function show(Grade $grade)
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

    public function plan(Grade $grade)
    {
        try {
            if ($grade->id) {
                $lectures = Plan::query()->where('grade_id', $grade->id)->orderBy('priority')->get();
                return $lectures->toArray();
            }
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Grade $grade)
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
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
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

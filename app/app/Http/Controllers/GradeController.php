<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Http\Services\Grade\GradeService;
use App\Http\Services\Plan\PlanService;
use App\Models\Grade;

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
    public function store(GradeStoreRequest $request, GradeService $service)
    {
        return $service->save($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade, GradeService $service)
    {
        return $service->getGradeData($grade);
    }

    public function plan(Grade $grade, PlanService $service)
    {
        return $service->getLectures($grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeUpdateRequest $request, Grade $grade, GradeService $service)
    {
        return $service->update($request, $grade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade, GradeService $service)
    {
        return $service->delete($grade);
    }
}

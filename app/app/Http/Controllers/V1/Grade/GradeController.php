<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Http\Resources\GradeResource;
use App\Services\Grade\GradeService;
use App\Services\Plan\PlanService;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request): array
    {
        $page = $request->input('page', 0);
        $limit = $request->input('limit', 10);
        $students = Grade::all()->forPage($page, $limit);
        return $students->toArray();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param GradeStoreRequest $request
     * @param GradeService $service
     * @return mixed
     */
    public function store(GradeStoreRequest $request, GradeService $service): mixed
    {
        return new GradeResource($service->save($request));
    }


    /**
     * Display the specified resource.
     *
     * @param Grade $grade
     * @param GradeService $service
     * @return array
     */
    public function show(Grade $grade, GradeService $service): array
    {
        return $service->getGradeData($grade);
    }

    /**
     * Возвращает информацию по конкретному учебному плану
     *
     * @param Grade $grade
     * @param PlanService $service
     * @return array
     */
    public function plan(Grade $grade, PlanService $service): array
    {
        return $service->getLectures($grade);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param GradeUpdateRequest $request
     * @param Grade $grade
     * @param GradeService $service
     * @return array
     */
    public function update(GradeUpdateRequest $request, Grade $grade, GradeService $service): array
    {
        return $service->update($request, $grade);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Grade $grade
     * @param GradeService $service
     * @return array
     */
    public function destroy(Grade $grade, GradeService $service): array
    {
        return $service->delete($grade);
    }
}

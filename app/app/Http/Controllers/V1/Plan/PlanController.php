<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Plan;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Grade;
use App\Services\Plan\PlanService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * PlanController
 */
class PlanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request, Grade $grade, PlanService $planService): JsonResource
    {
        return new PlanResource($planService->save($request, $grade));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Grade $grade
     * @return PlanResource
     */
    public function update(Request $request, Grade $grade, PlanService $planService): PlanResource
    {
        return new PlanResource($planService->update($request, $grade));
    }
}

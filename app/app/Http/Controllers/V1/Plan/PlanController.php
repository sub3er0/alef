<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Plan;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Grade;
use App\Models\Plan;
use App\Models\PlanLecture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;

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
    public function store(Request $request, Grade $grade): JsonResource
    {
        if ($grade->plan()->exists()) {
            throw new Exception('Учебный план уже создан для данного класса');
        }
        $planData = $request->get('plan');
        $name = $request->get('name');
        $plan = new Plan();
        DB::transaction(function() use ($planData, $grade, $plan, $name) {
            $plan->name = $name;
            $plan->save();
            foreach ($planData as $row) {
                $planLecture = new PlanLecture();
                $row['plan_id'] = $plan->id;
                $planLecture->fill($row);
                $planLecture->save();
            }
            $grade->plan_id = $plan->id;
            $grade->save();
        });

        return new PlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Grade $grade
     * @return PlanResource
     */
    public function update(Request $request, Grade $grade): PlanResource
    {
        $planData = $request->get('plan');
        $name = $request->get('name');
        if (!$grade->plan()->exists()) {
            $plan = new Plan();
        } else {
            $plan = $grade->plan;
        }
        DB::transaction(function() use ($planData, $grade, $name, $plan) {

            $plan->name = $name;
            PlanLecture::where('plan_id', $grade->plan->id)->delete();
            foreach ($planData as $row) {
                $planLecture = new PlanLecture();
                $row['plan_id'] = $grade->plan->id;
                $planLecture->fill($row);
                $planLecture->save();
            }
            $grade->plan_id = $plan->id;
            $grade->save();
        });

        return new PlanResource($plan);
    }
}

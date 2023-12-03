<?php

declare(strict_types=1);

namespace App\Services\Plan;

use App\Models\Grade;
use App\Models\Plan;
use App\Models\PlanLecture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;
use Illuminate\Http\Request;

/**
 * PlanService
 */
class PlanService
{
    /**
     * @param Grade $grade
     * @return Collection
     */
    public function getLectures(Grade $grade): Collection
    {
        return Grade::query()->find();
    }

    public function save(Request $request, Grade $grade)
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
        return $grade;
    }

    public function update(Request $request, Grade $grade)
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
        return $grade;
    }
}

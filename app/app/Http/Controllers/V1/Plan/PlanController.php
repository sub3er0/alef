<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Plan;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * PlanController
 */
class PlanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        try {
            $planData = $request->get('plan');
            foreach ($planData as $row) {
                $plan = new Plan();
                $plan->fill($row);
                $plan->save();
            }
            return $planData;
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Grade $grade
     * @return array
     */
    public function update(Request $request, Grade $grade): array
    {
        try {
            if (isset($grade->id)) {
                DB::transaction(function () use ($grade, $request) {
                    DB::table('plans')->where('grade_id', $grade->id)->delete();
                    $planData = $request->get('plan');
                    foreach ($planData as $row) {
                        $plan = new Plan();
                        $plan->fill($row);
                        $plan->save();
                    }
                }
                );
                return $request->get('plan');
            }
            return ['error' => true, 'message' => 'Нет класса с заданным id'];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

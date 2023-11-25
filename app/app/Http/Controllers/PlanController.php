<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
     */
    public function update(Request $request, Grade $grade)
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
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

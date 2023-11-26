<?php

declare(strict_types=1);

namespace App\Services\Plan;

use App\Models\Grade;
use App\Models\Plan;

/**
 * PlanService
 */
class PlanService
{
    /**
     * @param Grade $grade
     * @return array|mixed[]|void
     */
    public function getLectures(Grade $grade): array
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
}

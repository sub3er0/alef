<?php

declare(strict_types=1);

namespace App\Services\Plan;

use App\Models\Grade;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

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
}

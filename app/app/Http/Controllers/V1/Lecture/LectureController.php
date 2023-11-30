<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Lecture;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Services\Lecture\LectureService;
use App\Models\Lecture;
use Illuminate\Http\Request;

/**
 * LectureController
 */
class LectureController extends Controller
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
        $lectures = Lecture::all()->forPage($page, $limit);
        return $lectures->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LectureStoreRequest $request
     * @param LectureService $service
     * @return array
     */
    public function store(LectureStoreRequest $request, LectureService $service): array
    {
        return $service->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Lecture $lecture
     * @param LectureService $service
     * @return array
     */
    public function show(Lecture $lecture, LectureService $service): array
    {
        return $service->getLectureData($lecture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LectureUpdateRequest $request
     * @param Lecture $lecture
     * @param LectureService $service
     * @return array
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture, LectureService $service): array
    {
        return $service->update($request, $lecture);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lecture $lecture
     * @param LectureService $service
     * @return array
     */
    public function destroy(Lecture $lecture, LectureService $service): array
    {
        return $service->delete($lecture);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Lecture;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Http\Resources\LectureResource;
use App\Services\Lecture\LectureService;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * LectureController
 */
class LectureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request): ResourceCollection
    {
        $page = $request->input('page', 0);
        $limit = $request->input('limit', 10);
        return LectureResource::collection(Lecture::all()->forPage($page, $limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LectureStoreRequest $request
     * @param LectureService $service
     * @return JsonResource
     */
    public function store(LectureStoreRequest $request, LectureService $service): JsonResource
    {
        return new LectureResource($service->save($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Lecture $lecture
     * @param LectureService $service
     * @return JsonResource
     */
    public function show(Lecture $lecture, LectureService $service): JsonResource
    {
        return new LectureResource($service->getLectureData($lecture));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LectureUpdateRequest $request
     * @param Lecture $lecture
     * @param LectureService $service
     * @return array
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture, LectureService $service): JsonResource
    {
        return new LectureResource($service->update($request, $lecture));
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

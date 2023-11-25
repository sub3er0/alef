<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
use App\Http\Services\Lecture\LectureService;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Student;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures = Lecture::all();
        return $lectures->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request, LectureService $service)
    {
        return $service->save($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture, LectureService $service)
    {
        return $service->getLectureData($lecture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture, LectureService $service)
    {
        return $service->update($request, $lecture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture, LectureService $service)
    {
        return $service->delete($lecture);
    }
}

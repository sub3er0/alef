<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Services\Student\StudentService;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResource
    {
        $page = $request->input('page', 0);
        $limit = $request->input('limit', 10);
        return StudentResource::collection(Student::with('grade')->forPage($page, $limit)->get());
    }

    /**
     * @param StudentStoreRequest $request
     * @param StudentService $service
     * @return JsonResource
     */
    public function store(StudentStoreRequest $request, StudentService $service): JsonResource
    {
        return new StudentResource($service->save($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): JsonResource
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student, StudentService $service): JsonResource
    {
        return new StudentResource($service->update($request, $student));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, StudentService $service): array
    {
        return $service->delete($student);
    }
}

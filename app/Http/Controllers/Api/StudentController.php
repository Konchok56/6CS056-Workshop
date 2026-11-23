<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     * 200 OK
     */
    public function index()
    {
        $students = Student::all();

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created student.
     * 201 Created (422 if validation fails)
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified student.
     * 200 OK (404 if not found)
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified student.
     * 200 OK (422 if validation fails, 404 if not found)
     */
    public function update(
        UpdateStudentRequest $request,
        Student $student
    ) {
        $student->update($request->validated());

        return new StudentResource($student->fresh());
    }

    /**
     * Remove the specified student.
     * 204 No Content (404 if not found)
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(null, 204);
    }
}

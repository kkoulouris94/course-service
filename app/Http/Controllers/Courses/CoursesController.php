<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Services\CoursesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CoursesController extends Controller
{
    protected CoursesService $coursesService;

    public function __construct(CoursesService $coursesService)
    {
        $this->coursesService = $coursesService;
    }

    public function index(): JsonResponse
    {
        $courses = $this->coursesService->getAllCourses();

        return $this->successResponse($courses);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        // Validate input
        $rules = [
            'title' => 'required|max:250',
            'description' => 'required',
            'status' => [
                'required',
                Rule::in(['Published', 'Pending'])
            ],
            'is_premium' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $course = $this->coursesService->saveCourse($request->all());

        return $this->successResponse($course, ResponseAlias::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $course = $this->coursesService->getOneCourse($id);

        return $this->successResponse($course);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        // Validate input
        $rules = [
            'title' => 'max:250',
            'status' => [
                Rule::in(['Published', 'Pending'])
            ],
            'is_premium' => 'boolean'
        ];
        $this->validate($request, $rules);

        $course = $this->coursesService->updateCourse($id, $request->all());

        return $this->successResponse($course, ResponseAlias::HTTP_CREATED);
    }

    public function delete(int $id): JsonResponse
    {
        $this->coursesService->deleteCourse($id);

        return $this->successResponse(null, ResponseAlias::HTTP_NO_CONTENT);
    }

}

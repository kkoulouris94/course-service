<?php

namespace App\Http\Services;

use App\Http\Repositories\Courses\CoursesRepository;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CoursesService
{
    protected CoursesRepository $repository;

    public function __construct(CoursesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCourses(): Collection
    {
        return $this->repository->findAll();
    }

    public function getOneCourse(int $courseId): Model
    {
        return $this->repository->findById($courseId);
    }

    public function saveCourse(array $course): Model
    {
        // Check if there is a course with the same title
        if (isset($course['title'])) {
            /** @var Course $exists */
            $courseWithSameTitle = $this->repository->findByAttribute('title', $course['title']);

            // If exists warn user
            if ($courseWithSameTitle->exists) {
                throw new BadRequestException('This title is already taken');
            }
        }

        return $this->repository->store($course);
    }

    public function updateCourse(int $courseId, array $course): Model
    {
        // Check if there is a course with the same title
        if (isset($course['title'])) {
            /** @var Course $exists */
            $courseWithSameTitle = $this->repository->findByAttribute('title', $course['title']);

            // If exists warn user
            if ($courseWithSameTitle->exists) {
                throw new BadRequestException('This title is already taken');
            }
        }

        return $this->repository->update($courseId, $course);
    }

    public function deleteCourse(int $courseId): int
    {
        return $this->repository->deleteById($courseId);
    }
}

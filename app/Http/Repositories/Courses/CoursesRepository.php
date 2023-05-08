<?php

namespace App\Http\Repositories\Courses;

use App\Http\Repositories\CrudRepository;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CoursesRepository implements CrudRepository
{

    public function findAll(): Collection
    {
        return Course::all();
    }

    public function findById(int $id): Model
    {
        return Course::findOrFail($id);
    }

    public function store(array $attributes): Model
    {
        return Course::create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        /** @var Course $course */
        $course = Course::findOrFail($id);

        $course->fill($attributes);
        $course->save();

        return $course;
    }

    public function deleteById(int $id): int
    {
        return Course::destroy($id);
    }

    public function findByAttribute($key, $value)
    {
        return Course::where($key, $value)
            ->first();
    }
}

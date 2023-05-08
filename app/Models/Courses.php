<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Courses
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'status', 'is_premium'
    ];
}

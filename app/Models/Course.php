<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'status', 'is_premium'
    ];
}

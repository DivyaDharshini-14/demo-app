<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug',
    ];
//    public function coursesTypes()
//    {
//        return $this->hasMany(CoursesType::class);
//    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAssign extends Model
{
    protected $fillable = [
        'user_id', 'teacher_id', 'class_id'
    ];
}

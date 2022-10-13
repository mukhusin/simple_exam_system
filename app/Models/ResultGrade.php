<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_by',
        'from_marks',
        'to_marks',
        'grade',
    ];

}

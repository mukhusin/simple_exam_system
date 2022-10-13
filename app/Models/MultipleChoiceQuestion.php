<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_by',
        'exam_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
    ];

}

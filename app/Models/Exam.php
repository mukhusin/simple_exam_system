<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'total_qns',
        'weight_each',
        'muda',
        'start_date',
        'marks',
        'description',
        'passage',
        'deadline',
        'isActive',
        'type',
        'link',
        'updated_by',
    ];

}

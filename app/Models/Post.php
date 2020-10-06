<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'descriptions',
        'content',
        'date_public',
        'vacancy',
        'salary',
        'location',
        'job_nature',
        'user_id',
        'user_table',
        'category_id',
        'company_id',
        'status',
        'is_active',
        'salart_start',
        'salart_end',
        'request_degree',
        'request_old',
        'request_experience',
        'request_sex',
        'position',
        'deadline'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,softDeletes;
    protected $fillable = [
        'name','descriptions','parent_id','is_active','user_created_id','user_created_table','slug','deleted_at','id'
    ];
}

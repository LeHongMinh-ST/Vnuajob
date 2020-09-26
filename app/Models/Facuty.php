<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facuty extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'facuty_code', 'descriptions','is_active','deleted_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}

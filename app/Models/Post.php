<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
    'title',
    'sub_title',
    'description',
    'content',
    'image',
    'active',
    'created_by',
    'updated_by',
    'deleted_by',
    ];
}

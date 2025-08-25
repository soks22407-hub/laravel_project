<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    // If your table name is not plural, define it explicitly
    protected $table = 'site_setting';

    protected $fillable = [
        'title',
        'description',
        'content',
        'facebook',
        'telegram',
        'youtube',
        'logo',
    ];
}
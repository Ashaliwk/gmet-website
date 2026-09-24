<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'details',
        'link',
        'category',
        'technology',
        'client',
        'document',
        'timeline',
        'key_terms',
        'image',
        'is_featured',
        'order',
        'status'
    ];
}

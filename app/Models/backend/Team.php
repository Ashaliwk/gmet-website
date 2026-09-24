<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fullname',
        'email',
        'designation',
        'intro',
        'insta',
        'linkedin',
        'image',
        'status',
        'order'
    ];
}
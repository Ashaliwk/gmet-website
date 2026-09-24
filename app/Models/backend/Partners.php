<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;

    protected $table = 'partners';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'description',
        'website',
        'image',
        'order',
        'status',
    ];
}

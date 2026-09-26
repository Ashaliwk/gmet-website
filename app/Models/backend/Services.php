<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'order',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\backend\ServiceImage::class);
    }
}

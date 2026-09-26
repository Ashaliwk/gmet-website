<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;

    protected $table = 'service_images';

    protected $fillable = [
        'service_id',
        'image_path',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}

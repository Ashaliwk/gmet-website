<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satelliteimagery extends Model
{
    use HasFactory;

    protected $table = 'satellite_imageries';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'image',
        'client',
        'resolution',
        'sensor',
        'category',
        'project_date',
        'order',
        'status',
    ];

    protected $appends = ['image_url'];

    /**
     * Get the full URL for the satellite imagery image.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        $image = trim($this->image);

        // Data URI or absolute remote URL
        if (str_starts_with($image, 'data:') || str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        $cleanImage = ltrim($image, '/\\');

        if (file_exists(public_path($cleanImage))) {
            return asset($cleanImage);
        }

        if (file_exists(public_path('uploads/satellite_imagery/' . $cleanImage))) {
            return asset('uploads/satellite_imagery/' . $cleanImage);
        }

        if (file_exists(public_path('uploads/projects/' . $cleanImage))) {
            return asset('uploads/projects/' . $cleanImage);
        }

        if (file_exists(public_path('assets/images/' . $cleanImage))) {
            return asset('assets/images/' . $cleanImage);
        }

        if (file_exists(public_path('storage/' . $cleanImage))) {
            return asset('storage/' . $cleanImage);
        }

        if (str_starts_with($cleanImage, 'uploads/')) {
            return asset($cleanImage);
        }

        return asset('uploads/satellite_imagery/' . $cleanImage);
    }
}

// Alias class for PSR-4 PascalCase naming compatibility
if (!class_exists('App\Models\backend\SatelliteImagery', false)) {
    class_alias(satelliteimagery::class, 'App\Models\backend\SatelliteImagery');
}

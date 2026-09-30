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

    protected $appends = ['image_url'];

    /**
     * Get the full URL for the project image.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        $image = trim($this->image);

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, 'data:')) {
            return $image;
        }

        $cleanImage = ltrim($image, '/\\');

        if (file_exists(public_path($cleanImage))) {
            return asset($cleanImage);
        }

        if (file_exists(public_path('uploads/projects/' . $cleanImage))) {
            return asset('uploads/projects/' . $cleanImage);
        }

        if (file_exists(public_path('backend/images/projects/' . $cleanImage))) {
            return asset('backend/images/projects/' . $cleanImage);
        }

        if (file_exists(public_path('assets/images/' . $cleanImage))) {
            return asset('assets/images/' . $cleanImage);
        }

        if (file_exists(public_path('storage/' . $cleanImage))) {
            return asset('storage/' . $cleanImage);
        }

        if (str_starts_with($cleanImage, 'uploads/projects/')) {
            return asset($cleanImage);
        }

        return asset('uploads/projects/' . $cleanImage);
    }
}

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

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, 'data:')) {
            return $this->image;
        }

        if (file_exists(public_path('uploads/projects/' . $this->image))) {
            return asset('uploads/projects/' . $this->image);
        }

        if (file_exists(public_path('backend/images/projects/' . $this->image))) {
            return asset('backend/images/projects/' . $this->image);
        }

        if (file_exists(public_path('assets/images/' . $this->image))) {
            return asset('assets/images/' . $this->image);
        }

        if (file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('uploads/projects/' . $this->image);
    }
}

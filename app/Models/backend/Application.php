<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'app_number',
        'title',
        'description',
        'app_link',
        'image',
        'category',
        'technology',
        'is_featured',
        'order',
        'status',
    ];

    protected $appends = ['image_url', 'display_number'];

    /**
     * Relationship: registered users for this application
     */
    public function registrations()
    {
        return $this->hasMany(ApplicationRegistration::class, 'application_id')->orderBy('created_at', 'desc');
    }

    /**
     * Total count of registered users
     */
    public function getRegistrationsCountAttribute()
    {
        return $this->registrations()->count();
    }

    /**
     * Display number helper (e.g. APP-01 or #1)
     */
    public function getDisplayNumberAttribute()
    {
        if (!empty($this->app_number)) {
            return $this->app_number;
        }
        return 'APP-' . str_pad($this->id, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Image URL accessor helper
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, 'data:')) {
            return $this->image;
        }

        if (file_exists(public_path('uploads/applications/' . $this->image))) {
            return asset('uploads/applications/' . $this->image);
        }

        if (file_exists(public_path('backend/images/applications/' . $this->image))) {
            return asset('backend/images/applications/' . $this->image);
        }

        if (file_exists(public_path('assets/images/' . $this->image))) {
            return asset('assets/images/' . $this->image);
        }

        if (file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        return asset('uploads/applications/' . $this->image);
    }
}

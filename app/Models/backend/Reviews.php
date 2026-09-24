<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $primary_key = "id";
    protected $fillable = [
        'room_id',
        'booking_id',
        'name',
        'country',
        'guest_email',
        'title',
        'rating',
        'stay_date',
        'description',
        'sentiment',
        'summary',
        'image',
        'status',
        'is_verified_stay',
    ];

    protected $casts = [
        'stay_date' => 'date',
        'is_verified_stay' => 'boolean',
    ];

    public function room()
    {
        return $this->belongsTo(\App\Models\frontend\Room::class, 'room_id');
    }

    public function booking()
    {
        return $this->belongsTo(\App\Models\frontend\Booking::class, 'booking_id');
    }
}

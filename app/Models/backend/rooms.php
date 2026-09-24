<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $fillable = ['name', 'price', 'description', 'image', 'status', 'room_type', 'max_persons', 'ac_type', 'bed_type', 'meal_plan', 'room_status', 'is_wifi', 'is_parking'];
    protected $primary_key = "id";
}

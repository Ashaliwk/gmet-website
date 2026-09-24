<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\backend\rooms;

class DummyRoomSeeder extends Seeder
{
    public function run()
    {
        $types = ['luxury', 'single', 'suite', 'family'];
        $images = [
            'fs_room_1777228103.webp',
            'fs_room_1777228221.webp',
            'fs_room_1777228754.webp',
            'fs_room_1777228852.webp',
            'fs_room_1777229098.webp',
        ];

        foreach ($types as $type) {
            for ($i = 1; $i <= 2; $i++) {
                rooms::create([
                    'name' => ucfirst($type) . ' Room ' . $i,
                    'price' => rand(100, 500),
                    'description' => 'A wonderful ' . $type . ' room for your stay. Enjoy our premium amenities and great service. We are delighted to offer you a memorable experience.',
                    'image' => $images[array_rand($images)],
                    'status' => 1,
                    'room_type' => $type,
                    'max_persons' => $type == 'single' ? 1 : ($type == 'family' ? 4 : 2),
                    'ac_type' => 'AC',
                    'bed_type' => $type == 'single' ? 'Single Bed' : 'Double Bed',
                    'meal_plan' => 'Breakfast',
                    'room_status' => 'available',
                    'is_wifi' => 1,
                    'is_parking' => 1,
                ]);
            }
        }
    }
}

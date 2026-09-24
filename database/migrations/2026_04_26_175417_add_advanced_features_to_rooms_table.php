<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('room_type', 50)->nullable(); // economy, luxury, suite, family, single, double
            $table->integer('max_persons')->nullable();
            $table->string('ac_type', 50)->nullable(); // AC, Non-AC
            $table->string('bed_type', 50)->nullable(); // Single Bed, Double Bed
            $table->string('meal_plan', 50)->nullable(); // No Meal, Breakfast, Lunch, Dinner, Full Board
            $table->string('room_status', 50)->default('available'); // available, booked, maintenance
            $table->boolean('is_wifi')->default(0);
            $table->boolean('is_parking')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn([
                'room_type',
                'max_persons',
                'ac_type',
                'bed_type',
                'meal_plan',
                'room_status',
                'is_wifi',
                'is_parking'
            ]);
        });
    }
};

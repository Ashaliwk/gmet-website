<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE reviews 
            MODIFY name VARCHAR(255) NOT NULL,
            MODIFY country VARCHAR(255) NOT NULL,
            MODIFY description TEXT NOT NULL,
            MODIFY image VARCHAR(255) NOT NULL");

        Schema::table('reviews', function (Blueprint $table) {
            if (! Schema::hasColumn('reviews', 'room_id')) {
                $table->unsignedBigInteger('room_id')->nullable()->after('id');
            }
            if (! Schema::hasColumn('reviews', 'booking_id')) {
                $table->unsignedBigInteger('booking_id')->nullable()->unique()->after('room_id');
            }
            if (! Schema::hasColumn('reviews', 'guest_email')) {
                $table->string('guest_email')->nullable()->after('country');
            }
            if (! Schema::hasColumn('reviews', 'title')) {
                $table->string('title')->nullable()->after('guest_email');
            }
            if (! Schema::hasColumn('reviews', 'rating')) {
                $table->unsignedTinyInteger('rating')->default(5)->after('title');
            }
            if (! Schema::hasColumn('reviews', 'stay_date')) {
                $table->date('stay_date')->nullable()->after('rating');
            }
            if (! Schema::hasColumn('reviews', 'sentiment')) {
                $table->string('sentiment')->nullable()->after('description');
            }
            if (! Schema::hasColumn('reviews', 'summary')) {
                $table->text('summary')->nullable()->after('sentiment');
            }
            if (! Schema::hasColumn('reviews', 'is_verified_stay')) {
                $table->boolean('is_verified_stay')->default(false)->after('summary');
            }
        });

        if (! $this->hasForeignKey('reviews', 'reviews_room_id_foreign')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->foreign('room_id')->references('id')->on('rooms')->nullOnDelete();
            });
        }

        if (! $this->hasForeignKey('reviews', 'reviews_booking_id_foreign')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->foreign('booking_id')->references('id')->on('bookings')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropForeign(['booking_id']);
            $table->dropUnique(['booking_id']);
            $table->dropColumn([
                'room_id',
                'booking_id',
                'guest_email',
                'title',
                'rating',
                'stay_date',
                'sentiment',
                'summary',
                'is_verified_stay',
            ]);
        });
    }

    private function hasForeignKey(string $table, string $foreignKey): bool
    {
        $database = DB::getDatabaseName();

        return DB::table('information_schema.TABLE_CONSTRAINTS')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', $table)
            ->where('CONSTRAINT_NAME', $foreignKey)
            ->exists();
    }
};

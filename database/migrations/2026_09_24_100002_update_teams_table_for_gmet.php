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
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'status')) {
                $table->boolean('status')->default(1)->after('image');
            }
            if (!Schema::hasColumn('teams', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            if (!Schema::hasColumn('teams', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('insta');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            if (Schema::hasColumn('teams', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('teams', 'order')) {
                $table->dropColumn('order');
            }
            if (Schema::hasColumn('teams', 'linkedin')) {
                $table->dropColumn('linkedin');
            }
        });
    }
};

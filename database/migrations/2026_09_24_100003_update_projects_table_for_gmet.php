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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'document')) {
                $table->string('document')->nullable()->after('client');
            }
            if (!Schema::hasColumn('projects', 'timeline')) {
                $table->string('timeline')->nullable()->after('document');
            }
            if (!Schema::hasColumn('projects', 'key_terms')) {
                $table->text('key_terms')->nullable()->after('timeline');
            }
            if (!Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(0)->after('status');
            }
            if (!Schema::hasColumn('projects', 'order')) {
                $table->integer('order')->default(0)->after('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'document')) {
                $table->dropColumn('document');
            }
            if (Schema::hasColumn('projects', 'timeline')) {
                $table->dropColumn('timeline');
            }
            if (Schema::hasColumn('projects', 'key_terms')) {
                $table->dropColumn('key_terms');
            }
            if (Schema::hasColumn('projects', 'is_featured')) {
                $table->dropColumn('is_featured');
            }
            if (Schema::hasColumn('projects', 'order')) {
                $table->dropColumn('order');
            }
        });
    }
};

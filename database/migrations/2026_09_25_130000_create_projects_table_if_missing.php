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
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('details');
                $table->string('link');
                $table->string('category');
                $table->string('technology');
                $table->string('client');
                $table->string('document')->nullable();
                $table->string('timeline')->nullable();
                $table->text('key_terms')->nullable();
                $table->boolean('status')->default(1);
                $table->boolean('is_featured')->default(0);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
?>

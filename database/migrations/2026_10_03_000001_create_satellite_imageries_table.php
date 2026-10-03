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
        if (!Schema::hasTable('satellite_imageries')) {
            Schema::create('satellite_imageries', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('description');
                $table->longText('image')->nullable();
                $table->string('client')->nullable();
                $table->string('resolution')->nullable();
                $table->string('sensor')->nullable();
                $table->string('category')->nullable()->default('Optical Imagery');
                $table->string('project_date')->nullable();
                $table->integer('order')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellite_imageries');
    }
};

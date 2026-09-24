<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('room_id');
    $table->string('guest_name',50);
    $table->string('guest_email',50);
    $table->string('guest_phone',50);
    $table->date('check_in');
    $table->date('check_out');
    $table->integer('guests')->default(1);
    $table->decimal('total_price', 10, 2);
    $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
    $table->timestamps();
    $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
});

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

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
        Schema::create('hostels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('price');
            $table->string('location');
            $table->string('user_id');
            $table->string('no_rooms');
            $table->string('room_type');
            $table->string('hostel_features')->nullable();;
            $table->text('img_one')->nullable();;
            $table->text('img_two')->nullable();;
            $table->text('img_three')->nullable();;
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostels');
    }
};

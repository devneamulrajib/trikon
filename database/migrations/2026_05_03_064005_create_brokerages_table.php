<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brokerages', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('Land'); // Land or Flat
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location')->nullable();
            
            // Land Specific Fields
            $table->string('block_name')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('plot_serial')->nullable();
            $table->string('facing')->nullable();

            // Flat Specific Fields
            $table->string('area_sqft')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('balcony')->nullable();
            $table->string('floor_no')->nullable();
            $table->json('amenities')->nullable();

            // Common Fields
            $table->string('price');
            $table->string('property_id')->unique();
            $table->string('status')->default('For Sale');
            $table->json('images')->nullable();
            $table->longText('content')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brokerages');
    }
};
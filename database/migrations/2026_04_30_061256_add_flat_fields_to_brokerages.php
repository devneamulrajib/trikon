<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('brokerages', function (Blueprint $table) {
        $table->string('category')->default('Land'); // Land or Flat
        $table->string('area_sqft')->nullable();
        $table->string('bedrooms')->nullable();
        $table->string('bathrooms')->nullable();
        $table->string('balcony')->nullable();
        $table->string('floor_no')->nullable();
        $table->json('amenities')->nullable(); // For Lift, LPG, Parking, etc.
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brokerages', function (Blueprint $table) {
            //
        });
    }
};

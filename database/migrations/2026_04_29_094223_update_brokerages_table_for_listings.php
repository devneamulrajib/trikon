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
        $table->string('slug')->unique()->after('title');
        $table->json('images')->nullable()->after('hero_image'); // For multiple photos
        $table->string('block_name')->nullable();
        $table->string('plot_size')->nullable();
        $table->string('plot_serial')->nullable();
        $table->string('facing')->nullable(); // "Face" in your request
        $table->string('price')->nullable();
        $table->string('property_id')->nullable();
        $table->text('address')->nullable();
        $table->string('status')->default('For Sale'); // e.g., For Sale, New Listing, Hot Offer
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

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
    Schema::create('brokerages', function (Blueprint $table) {
        $table->id();
        $table->string('title')->default('Brokerage Services');
        $table->string('subtitle')->nullable();
        $table->string('hero_image')->nullable();
        $table->longText('content'); // This will store the main page text/HTML
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brokerages');
    }
};

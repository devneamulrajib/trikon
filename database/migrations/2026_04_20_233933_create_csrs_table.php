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
    Schema::create('csrs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('image'); // For the grid image
        $table->text('description')->nullable();
        $table->boolean('is_featured')->default(false); // To select which ones go in the top collage
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csrs');
    }
};

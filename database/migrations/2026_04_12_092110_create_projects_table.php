<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Project Name
            $table->string('location');       // Project Location
            $table->string('category');       // Ongoing, Upcoming, Completed
            $table->string('size')->nullable(); 
            $table->integer('progress')->default(0); 
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function up_settings(): void {
        // Just a placeholder
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
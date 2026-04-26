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
    Schema::table('sister_concerns', function (Blueprint $table) {
        if (!Schema::hasColumn('sister_concerns', 'slug')) {
            $table->string('slug')->unique()->after('name');
        }
        
        if (!Schema::hasColumn('sister_concerns', 'description')) {
            $table->text('description')->nullable();
        }

        if (!Schema::hasColumn('sister_concerns', 'video_url')) {
            $table->string('video_url')->nullable();
        }

        if (!Schema::hasColumn('sister_concerns', 'key_services')) {
            $table->json('key_services')->nullable();
        }

        if (!Schema::hasColumn('sister_concerns', 'core_values')) {
            $table->json('core_values')->nullable();
        }

        if (!Schema::hasColumn('sister_concerns', 'hero_image')) {
            $table->string('hero_image')->nullable();
        }

        if (!Schema::hasColumn('sister_concerns', 'side_image')) {
            $table->string('side_image')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sister_concerns', function (Blueprint $table) {
            //
        });
    }
};

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
    Schema::table('projects', function (Blueprint $table) {
        // This makes sure these columns can be empty without crashing
        $table->integer('progress')->default(0)->change();
        $table->string('featured_image')->nullable()->change();
        $table->string('amenities_image')->nullable()->change();
        $table->string('floorplan_image')->nullable()->change();
        $table->string('cover_photo')->nullable()->change();
        $table->string('brochure_pdf')->nullable()->change();
        $table->json('gallery')->nullable()->change();
        $table->json('construction_updates')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};

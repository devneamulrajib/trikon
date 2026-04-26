<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_name')->default('Trikon');
        $table->string('welcome_title')->nullable();
        $table->text('welcome_text')->nullable();
        $table->string('contact_email')->nullable();
        $table->string('contact_phone')->nullable();
        $table->string('address')->nullable();
        $table->string('facebook_url')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

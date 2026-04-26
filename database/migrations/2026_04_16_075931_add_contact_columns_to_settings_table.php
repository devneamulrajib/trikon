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
        Schema::table('settings', function (Blueprint $table) {
            // We add the missing columns. 
            // We use 'after' to keep the table organized.
            if (!Schema::hasColumn('settings', 'hotline')) {
                $table->string('hotline')->nullable()->after('site_name');
            }
            if (!Schema::hasColumn('settings', 'sales_phone')) {
                $table->string('sales_phone')->nullable()->after('hotline');
            }
            // Ensure email and address exist as well
            if (!Schema::hasColumn('settings', 'email')) {
                $table->string('email')->nullable()->after('sales_phone');
            }
            if (!Schema::hasColumn('settings', 'address')) {
                $table->text('address')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['hotline', 'sales_phone', 'email', 'address']);
        });
    }
};
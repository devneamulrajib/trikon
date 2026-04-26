<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $columns = [
                'slug' => ['type' => 'string', 'unique' => true, 'nullable' => true],
                'address' => ['type' => 'string', 'nullable' => true],
                'land_area' => ['type' => 'string', 'nullable' => true],
                'floors' => ['type' => 'string', 'nullable' => true],
                'size' => ['type' => 'string', 'nullable' => true],
                'beds_baths' => ['type' => 'string', 'nullable' => true],
                'launch_date' => ['type' => 'string', 'nullable' => true],
                'collection' => ['type' => 'string', 'default' => 'LUXURY'],
                'brochure_pdf' => ['type' => 'string', 'nullable' => true],
                'gallery' => ['type' => 'json', 'nullable' => true],
                'map_link' => ['type' => 'text', 'nullable' => true],
                'features' => ['type' => 'text', 'nullable' => true],
            ];

            foreach ($columns as $name => $attr) {
                if (!Schema::hasColumn('projects', $name)) {
                    $column = $table->{$attr['type']}($name);
                    if (isset($attr['unique']) && $attr['unique']) $column->unique();
                    if (isset($attr['nullable']) && $attr['nullable']) $column->nullable();
                    if (isset($attr['default'])) $column->default($attr['default']);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $cols = ['slug', 'address', 'land_area', 'floors', 'size', 'beds_baths', 'launch_date', 'collection', 'brochure_pdf', 'gallery', 'map_link', 'features'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('projects', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
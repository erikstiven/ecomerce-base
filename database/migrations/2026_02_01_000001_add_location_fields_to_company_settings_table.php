<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('company_settings', 'location_city')) {
                $table->string('location_city')->nullable()->after('location_address');
            }
            if (!Schema::hasColumn('company_settings', 'location_country')) {
                $table->string('location_country')->nullable()->after('location_city');
            }
            if (!Schema::hasColumn('company_settings', 'location_map_latitude')) {
                $table->string('location_map_latitude')->nullable()->after('location_map_embed');
            }
            if (!Schema::hasColumn('company_settings', 'location_map_longitude')) {
                $table->string('location_map_longitude')->nullable()->after('location_map_latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $columns = [
                'location_city',
                'location_country',
                'location_map_latitude',
                'location_map_longitude',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('company_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

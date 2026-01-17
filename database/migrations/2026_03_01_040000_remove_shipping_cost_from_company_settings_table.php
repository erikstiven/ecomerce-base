<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (Schema::hasColumn('company_settings', 'shipping_cost')) {
                $table->dropColumn('shipping_cost');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('company_settings', 'shipping_cost')) {
                $table->decimal('shipping_cost', 8, 2)->default(5.00)->after('location_map_longitude');
            }
        });
    }
};

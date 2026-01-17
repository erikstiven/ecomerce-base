<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('company_settings', 'payphone_enabled')) {
                $table->boolean('payphone_enabled')->default(false)->after('typography_font_url');
            }
            if (!Schema::hasColumn('company_settings', 'payphone_token')) {
                $table->string('payphone_token')->nullable()->after('payphone_enabled');
            }
            if (!Schema::hasColumn('company_settings', 'payphone_store_id')) {
                $table->string('payphone_store_id')->nullable()->after('payphone_token');
            }
            if (!Schema::hasColumn('company_settings', 'payphone_environment')) {
                $table->string('payphone_environment')->default('sandbox')->after('payphone_store_id');
            }
            if (!Schema::hasColumn('company_settings', 'payphone_domain')) {
                $table->string('payphone_domain')->nullable()->after('payphone_environment');
            }
            if (!Schema::hasColumn('company_settings', 'payphone_api_url')) {
                $table->string('payphone_api_url')->nullable()->after('payphone_domain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $columns = [
                'payphone_enabled',
                'payphone_token',
                'payphone_store_id',
                'payphone_environment',
                'payphone_domain',
                'payphone_api_url',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('company_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

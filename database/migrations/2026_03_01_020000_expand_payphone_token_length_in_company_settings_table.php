<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('company_settings', 'payphone_token')) {
            return;
        }

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE company_settings MODIFY payphone_token TEXT NULL');
        }
        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE company_settings ALTER COLUMN payphone_token TYPE TEXT');
        }
        if ($driver === 'sqlite') {
            // SQLite does not enforce string length; no action needed.
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('company_settings', 'payphone_token')) {
            return;
        }

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE company_settings MODIFY payphone_token VARCHAR(255) NULL');
        }
        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE company_settings ALTER COLUMN payphone_token TYPE VARCHAR(255)');
        }
        if ($driver === 'sqlite') {
            // SQLite does not enforce string length; no action needed.
        }
    }
};

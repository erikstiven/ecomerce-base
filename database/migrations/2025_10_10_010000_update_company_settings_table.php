<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->text('footer_description')->nullable()->change();

            if (!Schema::hasColumn('company_settings', 'footer_phone')) {
                $table->string('footer_phone')->nullable()->after('footer_email');
            }

            if (!Schema::hasColumn('company_settings', 'footer_logo')) {
                $table->string('footer_logo')->nullable()->after('footer_phone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('footer_description')->nullable()->change();

            if (Schema::hasColumn('company_settings', 'footer_phone')) {
                $table->dropColumn('footer_phone');
            }

            if (Schema::hasColumn('company_settings', 'footer_logo')) {
                $table->dropColumn('footer_logo');
            }
        });
    }
};

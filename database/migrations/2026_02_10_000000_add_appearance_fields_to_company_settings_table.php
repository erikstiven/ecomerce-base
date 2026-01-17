<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('company_settings', 'nav_top_bg')) {
                $table->string('nav_top_bg')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'nav_top_text')) {
                $table->string('nav_top_text')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'nav_top_hover')) {
                $table->string('nav_top_hover')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'nav_header_from')) {
                $table->string('nav_header_from')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'nav_header_via')) {
                $table->string('nav_header_via')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'nav_header_to')) {
                $table->string('nav_header_to')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'footer_from')) {
                $table->string('footer_from')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'footer_via')) {
                $table->string('footer_via')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'footer_to')) {
                $table->string('footer_to')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'footer_text')) {
                $table->string('footer_text')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'footer_muted')) {
                $table->string('footer_muted')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'typography_font_family')) {
                $table->string('typography_font_family')->nullable();
            }
            if (!Schema::hasColumn('company_settings', 'typography_font_url')) {
                $table->string('typography_font_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $columns = [
                'nav_top_bg',
                'nav_top_text',
                'nav_top_hover',
                'nav_header_from',
                'nav_header_via',
                'nav_header_to',
                'footer_from',
                'footer_via',
                'footer_to',
                'footer_text',
                'footer_muted',
                'typography_font_family',
                'typography_font_url',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('company_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

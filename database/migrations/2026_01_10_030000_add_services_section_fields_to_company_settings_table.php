<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('services_title')->nullable()->after('about_show_cta');
            $table->text('services_intro')->nullable()->after('services_title');
            $table->string('services_cta_label')->nullable()->after('services_intro');
            $table->string('services_cta_url')->nullable()->after('services_cta_label');
            $table->boolean('services_show_section')->default(true)->after('services_cta_url');
            $table->boolean('services_show_cta')->default(true)->after('services_show_section');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'services_title',
                'services_intro',
                'services_cta_label',
                'services_cta_url',
                'services_show_section',
                'services_show_cta',
            ]);
        });
    }
};

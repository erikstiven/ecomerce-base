<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('about_title')->nullable()->after('legal_company_name');
            $table->text('about_intro')->nullable()->after('about_title');
            $table->text('about_who')->nullable()->after('about_intro');
            $table->text('about_differentials')->nullable()->after('about_who');
            $table->text('about_process')->nullable()->after('about_differentials');
            $table->string('location_title')->nullable()->after('about_process');
            $table->text('location_description')->nullable()->after('location_title');
            $table->text('location_map_embed')->nullable()->after('location_description');
            $table->text('location_address')->nullable()->after('location_map_embed');
            $table->text('location_hours')->nullable()->after('location_address');
            $table->string('location_email')->nullable()->after('location_hours');
            $table->string('location_phone_primary')->nullable()->after('location_email');
            $table->string('location_phone_secondary')->nullable()->after('location_phone_primary');
            $table->string('location_phone_sales')->nullable()->after('location_phone_secondary');
            $table->string('faq_title')->nullable()->after('location_phone_sales');
            $table->text('faq_content')->nullable()->after('faq_title');
            $table->text('legal_terms_content')->nullable()->after('faq_content');
            $table->text('legal_privacy_content')->nullable()->after('legal_terms_content');
            $table->text('legal_returns_content')->nullable()->after('legal_privacy_content');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_title',
                'about_intro',
                'about_who',
                'about_differentials',
                'about_process',
                'location_title',
                'location_description',
                'location_map_embed',
                'location_address',
                'location_hours',
                'location_email',
                'location_phone_primary',
                'location_phone_secondary',
                'location_phone_sales',
                'faq_title',
                'faq_content',
                'legal_terms_content',
                'legal_privacy_content',
                'legal_returns_content',
            ]);
        });
    }
};

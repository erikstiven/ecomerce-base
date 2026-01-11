<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('about_eyebrow')->nullable()->after('legal_company_name');
            $table->string('about_lead')->nullable()->after('about_title');
            $table->text('about_mission')->nullable()->after('about_process');
            $table->text('about_story')->nullable()->after('about_mission');
            $table->string('about_cta_label')->nullable()->after('about_story');
            $table->string('about_cta_url')->nullable()->after('about_cta_label');
            $table->string('about_supporting')->nullable()->after('about_cta_url');
            $table->text('about_stats')->nullable()->after('about_supporting');
            $table->text('about_image_src')->nullable()->after('about_stats');
            $table->string('about_image_alt')->nullable()->after('about_image_src');
            $table->string('about_image_caption')->nullable()->after('about_image_alt');
            $table->string('about_trust_title')->nullable()->after('about_image_caption');
            $table->text('about_trust_items')->nullable()->after('about_trust_title');
            $table->text('about_values')->nullable()->after('about_trust_items');
            $table->boolean('about_show_narrative')->default(true)->after('about_values');
            $table->boolean('about_show_stats')->default(true)->after('about_show_narrative');
            $table->boolean('about_show_image')->default(true)->after('about_show_stats');
            $table->boolean('about_show_trust')->default(true)->after('about_show_image');
            $table->boolean('about_show_values')->default(true)->after('about_show_trust');
            $table->boolean('about_show_cta')->default(true)->after('about_show_values');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_eyebrow',
                'about_lead',
                'about_mission',
                'about_story',
                'about_cta_label',
                'about_cta_url',
                'about_supporting',
                'about_stats',
                'about_image_src',
                'about_image_alt',
                'about_image_caption',
                'about_trust_title',
                'about_trust_items',
                'about_values',
                'about_show_narrative',
                'about_show_stats',
                'about_show_image',
                'about_show_trust',
                'about_show_values',
                'about_show_cta',
            ]);
        });
    }
};

<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class AppearanceSeeder extends Seeder
{
    /**
     * Seed default appearance settings.
     */
    public function run(): void
    {
        $defaults = [
            'nav_top_bg' => '#0f172a',
            'nav_top_text' => '#ffffff',
            'nav_top_hover' => '#e2e8f0',
            'nav_header_from' => '#4c1d95',
            'nav_header_via' => '#1e3a8a',
            'nav_header_to' => '#7e22ce',
            'footer_from' => '#4c1d95',
            'footer_via' => '#1e3a8a',
            'footer_to' => '#7e22ce',
            'footer_text' => '#ffffff',
            'footer_muted' => '#c7d2fe',
            'typography_font_family' => 'Plus Jakarta Sans, sans-serif',
            'typography_font_url' => 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap',
        ];

        $settings = CompanySetting::query()->firstOrNew();

        foreach ($defaults as $key => $value) {
            $current = $settings->{$key};

            if ($current === null || $current === '') {
                $settings->{$key} = $value;
            }
        }

        $settings->save();
    }
}

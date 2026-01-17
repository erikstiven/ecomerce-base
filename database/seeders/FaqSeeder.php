<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $fallback = 'codecima codecima codecima codecima';

        $defaults = [
            'faq_title' => 'Preguntas frecuentes',
            'faq_content' => 'Resolvemos las dudas más comunes para ayudarte a comprar con confianza.',
            'faq_show_section' => true,
        ];

        $settings = CompanySetting::query()->firstOrNew();
        if (empty($settings->name)) {
            $settings->name = 'Mi tienda';
        }

        foreach ($defaults as $key => $value) {
            $current = $settings->{$key};
            if ($current === null || $current === '') {
                $settings->{$key} = $value;
            }
        }

        foreach (array_keys($defaults) as $key) {
            $current = $settings->{$key};
            if ($current === null || $current === '') {
                $settings->{$key} = $fallback;
            }
        }

        $settings->save();

        if (Faq::query()->exists()) {
            return;
        }

        $faqs = [
            [
                'question' => '¿Cómo realizo una compra?',
                'answer' => $fallback,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => '¿Qué métodos de pago están disponibles?',
                'answer' => $fallback,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => '¿Cómo gestiono un cambio o devolución?',
                'answer' => $fallback,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->create($faq);
        }
    }
}

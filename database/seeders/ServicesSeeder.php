<?php

namespace Database\Seeders;

use App\Models\CompanyService;
use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Seed default Services section content for a new tenant/store.
     */
    public function run(): void
    {
        $fallback = 'codecima codecima codecima codecima';

        $defaults = [
            'services_title' => 'Servicios que se adaptan a tu negocio',
            'services_intro' => 'Soluciones flexibles para acompañar cada etapa de tu tienda online.',
            'services_cta_label' => 'Ver todos los servicios',
            'services_cta_url' => '#servicios',
            'services_show_section' => true,
            'services_show_cta' => true,
        ];

        $settings = CompanySetting::query()->firstOrNew();

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

        if (CompanyService::query()->exists()) {
            return;
        }

        $services = [
            [
                'title' => 'Estrategia comercial',
                'description' => 'Definimos objetivos, propuesta de valor y prioridades para vender mejor.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Experiencia de compra',
                'description' => 'Diseñamos recorridos claros para facilitar la decisión del cliente.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Gestión y soporte',
                'description' => 'Acompañamiento continuo para operar sin fricciones.',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            CompanyService::query()->create($service);
        }
    }
}

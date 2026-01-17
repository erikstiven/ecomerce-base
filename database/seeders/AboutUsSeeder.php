<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Seed the About Us default content for a new tenant/store.
     */
    public function run(): void
    {
        // Fallback text used when a field is empty or null.
        $fallback = 'codecima codecima codecima codecima';

        // Default content for each About Us block.
        $defaults = [
            // Header
            'about_eyebrow' => 'Sobre la tienda',
            'about_title' => 'Construimos experiencias de compra confiables',
            'about_lead' => 'Acompañamos a cada negocio con una experiencia clara, cercana y adaptable a su etapa.',

            // Narrative
            'about_mission' => 'Creamos recorridos simples y seguros para que comprar sea fácil desde el primer clic.',
            'about_story' => 'Combinamos estrategia, diseño y soporte humano para responder a las necesidades de cada marca y de sus clientes.',

            // CTA
            'about_cta_label' => 'Descubre cómo trabajamos',
            'about_cta_url' => '#contacto',
            'about_supporting' => 'Compromiso con cada cliente',

            // Stats (one item per line, format: value | label)
            'about_stats' => implode("\n", [
                'Atención cercana | Acompañamiento en cada etapa',
                'Procesos claros | Información simple y transparente',
                'Compra confiable | Seguridad y confianza para tus clientes',
            ]),

            // Image
            'about_image_src' => 'https://media.licdn.com/dms/image/v2/D5612AQEyRXgGNWKtfw/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1674153064686?e=2147483647&v=beta&t=LjLsycv0L2SliO8GN9MFKIW6tdkoXlZZB8A7VbeAD6k',
            'about_image_alt' => 'Equipo enfocado en soluciones personalizadas',
            'about_image_caption' => 'Trabajo colaborativo orientado a mejorar la experiencia de compra',

            // Trust (one item per line)
            'about_trust_title' => 'Confianza en cada paso',
            'about_trust_items' => implode("\n", [
                'Pagos seguros y opciones visibles',
                'Políticas claras y fáciles de entender',
                'Acompañamiento antes y después de la compra',
            ]),

            // Values (one item per line, format: title | description)
            'about_values' => implode("\n", [
                'Transparencia | Comunicación clara y accesible para clientes y equipos',
                'Experiencia cuidada | Detalles pensados para generar confianza y fidelidad',
                'Flexibilidad | Procesos que se ajustan a negocios nuevos o en crecimiento',
            ]),

            // Visibility toggles
            'about_show_narrative' => true,
            'about_show_stats' => true,
            'about_show_image' => true,
            'about_show_trust' => true,
            'about_show_values' => true,
            'about_show_cta' => true,
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

        // Ensure any remaining empty fields show the fallback text.
        foreach (array_keys($defaults) as $key) {
            $current = $settings->{$key};

            if ($current === null || $current === '') {
                $settings->{$key} = $fallback;
            }
        }

        $settings->save();
    }
}

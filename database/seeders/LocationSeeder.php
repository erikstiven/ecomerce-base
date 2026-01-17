<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $fallback = 'codecima codecima codecima codecima';
        $defaultMapEmbed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0861775384556!2d-122.40109278468156!3d37.793617979756695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064dba9e3db%3A0x3a33dcb162d6c4c7!2sGoogle%20Building%2041!5e0!3m2!1ses!2sus!4v1700000000000!5m2!1ses!2sus';

        $defaults = [
            'location_title' => 'Nuestra ubicación',
            'location_description' => 'Encuéntranos fácilmente y visítanos cuando lo necesites.',
            'location_address' => 'codecima codecima codecima',
            'location_city' => 'codecima',
            'location_country' => 'codecima',
            'location_map_embed' => $defaultMapEmbed,
            'shipping_cost' => 5.00,
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
    }
}

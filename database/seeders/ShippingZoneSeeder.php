<?php

namespace Database\Seeders;

use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingZoneSeeder extends Seeder
{
    public function run(): void
    {
        ShippingZone::query()->firstOrCreate(
            ['name' => 'Tarifa general'],
            [
                'province' => null,
                'city' => null,
                'price' => 5.00,
                'is_active' => true,
                'is_default' => true,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class PayphoneSettingSeeder extends Seeder
{
    /**
     * Seed default PayPhone and bank deposit settings.
     */
    public function run(): void
    {
        $settings = CompanySetting::query()->firstOrNew();

        if (empty($settings->name)) {
            $settings->name = 'Mi tienda';
        }

        $defaults = [
            'payphone_enabled' => false,
            'payphone_environment' => 'sandbox',
            'bank_deposit_enabled' => true,
            'bank_name' => 'Banco Pichincha',
            'bank_account_type' => 'Cuenta de ahorro transaccional',
            'bank_account_number' => '2208765620',
            'bank_transfer_instructions' => 'Envía el comprobante e indica el número de tu pedido.',
            'bank_whatsapp' => '+593979018689',
            'bank_whatsapp_message' => 'Hola, adjunto el comprobante de mi pedido.',
        ];

        foreach ($defaults as $key => $value) {
            $current = $settings->{$key};
            if ($current === null || $current === '') {
                $settings->{$key} = $value;
            }
        }

        $settings->save();
    }
}

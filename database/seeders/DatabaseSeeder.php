<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Option;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Contracts\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products'); // Clear the products directory before seeding
        Storage::makeDirectory('products'); // Create the products directory
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //crear un usuario administrador si no existe
        \App\Models\User::query()->firstOrCreate(
            ['email' => 'admin@codecima.com'],
            [
                'name' => 'Codecima',
                'last_name' => 'Ecuador',
                'document_type' => 1, // Assuming 1 is a valid document type
                'document_number' => '0705871689',
                'phone' => '0979018689',
                'password' => bcrypt('codecima2026'), // Password is hashed
            ]
        );

        \App\Models\User::factory(20)->create();


        $this->call(
            [
                PermissionSeeder::class,
                RoleSeeder::class,
                AboutUsSeeder::class,
                AppearanceSeeder::class,
                ServicesSeeder::class,
                LocationSeeder::class,
                FaqSeeder::class,
                PayphoneSettingSeeder::class,
                ShippingZoneSeeder::class,
                //FamilySeeder::class,                    // Add other seeders here if needed
                //OptionSeeder::class,
            ]
        );

        //Product::factory(150)->create();
    }
}

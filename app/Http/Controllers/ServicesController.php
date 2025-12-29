<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = \App\Models\CompanyService::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $fallbackServices = [
            [
                'title' => 'Serigrafía',
                'description' => 'Impresión textil de alta durabilidad con tintas profesionales.',
                'image_path' => null,
            ],
            [
                'title' => 'Bordado',
                'description' => 'Acabado premium con hilos de alta calidad.',
                'image_path' => null,
            ],
            [
                'title' => 'Sublimado',
                'description' => 'Ideal para prendas deportivas y personalizadas.',
                'image_path' => null,
            ],
        ];

        return view('services.index', [
            'services' => $services->isNotEmpty() ? $services : collect($fallbackServices),
        ]);
    }
}

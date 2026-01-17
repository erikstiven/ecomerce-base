<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class AppearanceSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function edit()
    {
        return view('admin.settings.appearance', [
            'settings' => CompanySetting::query()->first(),
        ]);
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::query()->firstOrNew();

        $fontUrl = $request->input('typography_font_url');
        if (!empty($fontUrl)) {
            $request->merge([
                'typography_font_url' => $this->normalizeFontUrl($fontUrl),
            ]);
        }

        $validated = $request->validate([
            'nav_top_bg' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'nav_top_text' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'nav_top_hover' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'nav_header_from' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'nav_header_via' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'nav_header_to' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'footer_from' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'footer_via' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'footer_to' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'footer_text' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'footer_muted' => ['nullable', 'string', 'max:20', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'typography_font_family' => ['nullable', 'string', 'max:255'],
            'typography_font_url' => ['nullable', 'url', 'max:255'],
        ]);

        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.appearance.edit')
            ->with('status', 'Apariencia actualizada correctamente.');
    }

    private function normalizeFontUrl(string $url): string
    {
        $parts = parse_url($url);

        if (!$parts || empty($parts['host'])) {
            return $url;
        }

        $host = $parts['host'];
        $path = $parts['path'] ?? '';

        if (str_contains($host, 'fonts.googleapis.com')) {
            return $url;
        }

        if (!str_contains($host, 'fonts.google.com')) {
            return $url;
        }

        if ($path === '/share' && !empty($parts['query'])) {
            parse_str($parts['query'], $query);
            $family = $query['selection.family'] ?? $query['family'] ?? null;

            if ($family) {
                return $this->buildGoogleFontsCssUrl($family);
            }
        }

        if (str_starts_with($path, '/specimen/')) {
            $family = trim(str_replace('/specimen/', '', $path), '/');

            return $this->buildGoogleFontsCssUrl($family);
        }

        return $url;
    }

    private function buildGoogleFontsCssUrl(string $family): string
    {
        $families = array_filter(array_map('trim', explode('|', $family)));

        if (empty($families)) {
            return 'https://fonts.googleapis.com/css2?display=swap';
        }

        $familyParams = array_map(
            static fn(string $item) => 'family=' . str_replace(' ', '+', $item),
            $families
        );

        return 'https://fonts.googleapis.com/css2?' . implode('&', $familyParams) . '&display=swap';
    }
}

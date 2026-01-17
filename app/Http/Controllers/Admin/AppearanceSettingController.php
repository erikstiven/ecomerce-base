<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppearanceSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function edit()
    {
        $fontOptions = $this->getTypographyFontOptions();
        $settings = CompanySetting::query()->first();
        $selectedFontChoice = null;

        if ($settings) {
            foreach ($fontOptions as $key => $option) {
                if (
                    ($settings->typography_font_family ?? null) === $option['family']
                    && ($settings->typography_font_url ?? null) === $option['url']
                ) {
                    $selectedFontChoice = $key;
                    break;
                }
            }
        }

        return view('admin.settings.appearance', [
            'settings' => $settings,
            'fontOptions' => $fontOptions,
            'selectedFontChoice' => $selectedFontChoice,
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

        $fontOptions = $this->getTypographyFontOptions();

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
            'typography_font_choice' => ['nullable', 'string', Rule::in(array_keys($fontOptions))],
            'typography_font_family' => ['nullable', 'string', 'max:255'],
            'typography_font_url' => ['nullable', 'url', 'max:255'],
        ]);

        if (!empty($validated['typography_font_choice'])) {
            $choice = $validated['typography_font_choice'];

            if (array_key_exists($choice, $fontOptions)) {
                $validated['typography_font_family'] = $fontOptions[$choice]['family'];
                $validated['typography_font_url'] = $fontOptions[$choice]['url'];
            }
        }

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

    private function getTypographyFontOptions(): array
    {
        return [
            'plus-jakarta' => [
                'label' => 'Plus Jakarta Sans',
                'family' => 'Plus Jakarta Sans, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'inter' => [
                'label' => 'Inter',
                'family' => 'Inter, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'poppins' => [
                'label' => 'Poppins',
                'family' => 'Poppins, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'montserrat' => [
                'label' => 'Montserrat',
                'family' => 'Montserrat, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'nunito' => [
                'label' => 'Nunito',
                'family' => 'Nunito, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'open-sans' => [
                'label' => 'Open Sans',
                'family' => 'Open Sans, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap',
            ],
            'roboto' => [
                'label' => 'Roboto',
                'family' => 'Roboto, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap',
            ],
            'lato' => [
                'label' => 'Lato',
                'family' => 'Lato, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap',
            ],
            'source-sans' => [
                'label' => 'Source Sans 3',
                'family' => 'Source Sans 3, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'raleway' => [
                'label' => 'Raleway',
                'family' => 'Raleway, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'work-sans' => [
                'label' => 'Work Sans',
                'family' => 'Work Sans, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'mukta' => [
                'label' => 'Mukta',
                'family' => 'Mukta, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'manrope' => [
                'label' => 'Manrope',
                'family' => 'Manrope, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'urbanist' => [
                'label' => 'Urbanist',
                'family' => 'Urbanist, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Urbanist:wght@200;300;400;500;600;700;800&display=swap',
            ],
            'rubik' => [
                'label' => 'Rubik',
                'family' => 'Rubik, sans-serif',
                'url' => 'https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800&display=swap',
            ],
        ];
    }
}

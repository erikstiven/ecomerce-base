<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function index()
    {
        return view('admin/settings/faqs/index', [
            'faqs' => Faq::query()->orderBy('sort_order')->orderBy('id')->get(),
            'settings' => \App\Models\CompanySetting::query()->first(),
        ]);
    }

    public function create()
    {
        return view('admin/settings/faqs/form', [
            'faq' => new Faq(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:4000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $faq = new Faq();
        $faq->fill($validated);
        $faq->is_active = (bool) ($validated['is_active'] ?? false);
        $faq->sort_order = $validated['sort_order'] ?? 0;
        $faq->save();

        return redirect()
            ->route('admin.settings.company.faqs.index')
            ->with('status', 'Pregunta creada correctamente.');
    }

    public function edit(Faq $faq)
    {
        return view('admin/settings/faqs/form', [
            'faq' => $faq,
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:4000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $faq->fill($validated);
        $faq->is_active = (bool) ($validated['is_active'] ?? false);
        $faq->sort_order = $validated['sort_order'] ?? 0;
        $faq->save();

        return redirect()
            ->route('admin.settings.company.faqs.index')
            ->with('status', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.settings.company.faqs.index')
            ->with('status', 'Pregunta eliminada correctamente.');
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'faq_title' => ['nullable', 'string', 'max:255', 'required_if:faq_show_section,1'],
            'faq_content' => ['nullable', 'string', 'max:2000', 'required_if:faq_show_section,1'],
            'faq_show_section' => ['nullable'],
        ]);

        $validated['faq_show_section'] = $request->boolean('faq_show_section');

        $settings = \App\Models\CompanySetting::query()->firstOrNew();
        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.company.faqs.index')
            ->with('status', 'Configuración de FAQ actualizada.');
    }
}

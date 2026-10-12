<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LayoutAdminController extends Controller
{
    /**
     * Show the login form for Admin Layout.
     */
    public function login(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdminLayout()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle authentication for Admin Layout.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (! Auth::user()->isAdminLayout()) {
                Auth::logout();

                return back()->withErrors(['email' => 'Akun Anda tidak memiliki izin Admin Layout.']);
            }

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang di Panel Admin Layout!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Log out from Admin Layout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Admin Dashboard Overview.
     */
    public function dashboard(): View
    {
        $settings = SiteSetting::allKeyed();
        $totalServices = Service::count();
        $activeServices = Service::where('is_active', true)->count();

        $presetBackgrounds = [
            'images/backgrounds/hero-tech-workshop.jpg' => 'Bengkel PC & Hardware High-Tech',
            'images/backgrounds/hero-phone-repair.jpg' => 'Servis HP & Mikroskop Presisi',
        ];

        return view('admin.dashboard', compact('settings', 'totalServices', 'activeServices', 'presetBackgrounds'));
    }

    /**
     * Hero & Layout Background Editor.
     */
    public function hero(): View
    {
        $settings = SiteSetting::allKeyed();

        $presetBackgrounds = [
            'images/backgrounds/hero-tech-workshop.jpg' => 'Bengkel PC & Hardware High-Tech',
            'images/backgrounds/hero-phone-repair.jpg' => 'Servis HP & Mikroskop Presisi',
        ];

        return view('admin.hero', compact('settings', 'presetBackgrounds'));
    }

    /**
     * Update Hero & Background Settings.
     */
    public function updateHero(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_headline' => ['required', 'string', 'max:255'],
            'hero_subheadline' => ['required', 'string'],
            'hero_badge' => ['nullable', 'string', 'max:100'],
            'hero_cta_text' => ['required', 'string', 'max:100'],
            'hero_trust_1' => ['nullable', 'string', 'max:100'],
            'hero_trust_2' => ['nullable', 'string', 'max:100'],
            'hero_trust_3' => ['nullable', 'string', 'max:100'],

            'hero_card_title' => ['required', 'string', 'max:100'],
            'hero_card_subtitle' => ['required', 'string', 'max:150'],
            'hero_card_point_1_title' => ['required', 'string', 'max:150'],
            'hero_card_point_1_desc' => ['required', 'string', 'max:255'],
            'hero_card_point_2_title' => ['required', 'string', 'max:150'],
            'hero_card_point_2_desc' => ['required', 'string', 'max:255'],
            'hero_card_point_3_title' => ['required', 'string', 'max:150'],
            'hero_card_point_3_desc' => ['required', 'string', 'max:255'],

            'hero_bg_selection' => ['nullable', 'string'],
            'hero_bg_opacity' => ['required', 'integer', 'min:5', 'max:90'],
            'show_hero_bg' => ['nullable'],
            'hero_bg_file' => ['nullable', 'image', 'max:8192'],
        ]);

        // Process custom image upload if provided
        $heroBgPath = $validated['hero_bg_selection'] ?? 'images/backgrounds/hero-tech-workshop.jpg';

        if ($request->hasFile('hero_bg_file')) {
            $file = $request->file('hero_bg_file');
            $filename = 'hero_custom_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/backgrounds'), $filename);
            $heroBgPath = 'images/backgrounds/'.$filename;
        }

        SiteSetting::set('hero_headline', $validated['hero_headline'], 'hero');
        SiteSetting::set('hero_subheadline', $validated['hero_subheadline'], 'hero');
        SiteSetting::set('hero_badge', $validated['hero_badge'] ?? '', 'hero');
        SiteSetting::set('hero_cta_text', $validated['hero_cta_text'], 'hero');
        SiteSetting::set('hero_trust_1', $validated['hero_trust_1'] ?? '', 'hero');
        SiteSetting::set('hero_trust_2', $validated['hero_trust_2'] ?? '', 'hero');
        SiteSetting::set('hero_trust_3', $validated['hero_trust_3'] ?? '', 'hero');

        SiteSetting::set('hero_card_title', $validated['hero_card_title'], 'hero');
        SiteSetting::set('hero_card_subtitle', $validated['hero_card_subtitle'], 'hero');
        SiteSetting::set('hero_card_point_1_title', $validated['hero_card_point_1_title'], 'hero');
        SiteSetting::set('hero_card_point_1_desc', $validated['hero_card_point_1_desc'], 'hero');
        SiteSetting::set('hero_card_point_2_title', $validated['hero_card_point_2_title'], 'hero');
        SiteSetting::set('hero_card_point_2_desc', $validated['hero_card_point_2_desc'], 'hero');
        SiteSetting::set('hero_card_point_3_title', $validated['hero_card_point_3_title'], 'hero');
        SiteSetting::set('hero_card_point_3_desc', $validated['hero_card_point_3_desc'], 'hero');

        SiteSetting::set('hero_bg_image', $heroBgPath, 'hero');
        SiteSetting::set('hero_bg_opacity', $validated['hero_bg_opacity'], 'hero', 'integer');
        SiteSetting::set('show_hero_bg', $request->has('show_hero_bg') ? '1' : '0', 'hero', 'boolean');

        return back()->with('success', 'Layout Hero dan Background berhasil diperbarui!');
    }

    /**
     * Services Catalog Management.
     */
    public function services(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Create New Service Form.
     */
    public function createService(): View
    {
        $categories = [
            'Web Development',
            'Reparasi & Servis',
            'Rakit PC',
            'Sewa Audio',
            'Jual Beli Gadget',
            'Install Ulang OS',
        ];

        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store New Service.
     */
    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'badge' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'features' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features'] ?? ''))));

        Service::create([
            'slug' => Str::slug($validated['title']).'-'.time(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'],
            'features' => $features,
            'icon' => $validated['icon'] ?? 'wrench-screwdriver',
            'sort_order' => $validated['sort_order'] ?? (Service::max('sort_order') + 1),
            'is_active' => true,
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    /**
     * Edit Service Form.
     */
    public function editService(Service $service): View
    {
        $categories = [
            'Web Development',
            'Reparasi & Servis',
            'Rakit PC',
            'Sewa Audio',
            'Jual Beli Gadget',
            'Install Ulang OS',
        ];

        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update Service.
     */
    public function updateService(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'badge' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'features' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features'] ?? ''))));

        $service->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'],
            'features' => $features,
            'icon' => $validated['icon'] ?? $service->icon,
            'sort_order' => $validated['sort_order'] ?? $service->sort_order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services')->with('success', "Layanan '{$service->title}' berhasil diperbarui!");
    }

    /**
     * Delete Service.
     */
    public function deleteService(Service $service): RedirectResponse
    {
        $title = $service->title;
        $service->delete();

        return redirect()->route('admin.services')->with('success', "Layanan '{$title}' telah dihapus.");
    }

    /**
     * Media & Background Gallery Management.
     */
    public function media(): View
    {
        $settings = SiteSetting::allKeyed();

        $presetBackgrounds = [
            'images/backgrounds/hero-tech-workshop.jpg' => [
                'title' => 'Bengkel PC & Hardware High-Tech',
                'description' => 'Foto suasana bengkel teknisi, motherboard, multimeter, PC gaming liquid cooling, pencahayaan biru neon.',
            ],
            'images/backgrounds/hero-phone-repair.jpg' => [
                'title' => 'Servis HP & Mikroskop Presisi',
                'description' => 'Foto meja kerja servis handphone, mikroskop presisi, baterai, LCD, dan peralatan solder chip.',
            ],
        ];

        return view('admin.media', compact('settings', 'presetBackgrounds'));
    }

    /**
     * Business, Contact & Workshop Info Management.
     */
    public function business(): View
    {
        $settings = SiteSetting::allKeyed();

        return view('admin.business', compact('settings'));
    }

    /**
     * Update Business, Contact & Workshop Info.
     */
    public function updateBusiness(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'business_tagline' => ['required', 'string', 'max:255'],
            'business_description' => ['required', 'string'],
            'business_whatsapp' => ['required', 'string', 'max:50'],
            'business_whatsapp_display' => ['required', 'string', 'max:50'],
            'business_address' => ['required', 'string', 'max:255'],
            'business_operating_hours' => ['required', 'string', 'max:255'],
        ]);

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val, 'business');
        }

        return back()->with('success', 'Informasi bisnis, kontak, dan workshop berhasil diperbarui!');
    }

    /**
     * Keunggulan & Alur Layanan Management.
     */
    public function advantages(): View
    {
        $settings = SiteSetting::allKeyed();

        return view('admin.advantages', compact('settings'));
    }

    /**
     * Update Keunggulan & Alur Layanan Content.
     */
    public function updateAdvantages(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'advantages_eyebrow' => ['required', 'string', 'max:255'],
            'advantages_title' => ['required', 'string', 'max:255'],
            'advantages_subtitle' => ['required', 'string'],
            'advantages_highlight_title' => ['nullable', 'string', 'max:255'],
            'advantages_highlight_desc' => ['nullable', 'string'],
            'advantages_highlight_bullet_1' => ['nullable', 'string', 'max:255'],
            'advantages_highlight_bullet_2' => ['nullable', 'string', 'max:255'],
            'advantages_highlight_bullet_3' => ['nullable', 'string', 'max:255'],
            'advantages_highlight_bullet_4' => ['nullable', 'string', 'max:255'],

            'adv_1_badge' => ['required', 'string', 'max:100'],
            'adv_1_title' => ['required', 'string', 'max:255'],
            'adv_1_desc' => ['required', 'string'],
            'adv_1_point' => ['required', 'string', 'max:100'],

            'adv_2_badge' => ['required', 'string', 'max:100'],
            'adv_2_title' => ['required', 'string', 'max:255'],
            'adv_2_desc' => ['required', 'string'],
            'adv_2_point' => ['required', 'string', 'max:100'],

            'adv_3_badge' => ['required', 'string', 'max:100'],
            'adv_3_title' => ['required', 'string', 'max:255'],
            'adv_3_desc' => ['required', 'string'],
            'adv_3_point' => ['required', 'string', 'max:100'],

            'adv_4_badge' => ['required', 'string', 'max:100'],
            'adv_4_title' => ['required', 'string', 'max:255'],
            'adv_4_desc' => ['required', 'string'],
            'adv_4_point' => ['required', 'string', 'max:100'],

            'workflow_eyebrow' => ['required', 'string', 'max:255'],
            'workflow_title' => ['required', 'string', 'max:255'],
            'workflow_subtitle' => ['required', 'string'],
            'workflow_1_title' => ['required', 'string', 'max:255'],
            'workflow_1_desc' => ['required', 'string'],
            'workflow_2_title' => ['required', 'string', 'max:255'],
            'workflow_2_desc' => ['required', 'string'],
            'workflow_3_title' => ['required', 'string', 'max:255'],
            'workflow_3_desc' => ['required', 'string'],
            'workflow_4_title' => ['required', 'string', 'max:255'],
            'workflow_4_desc' => ['required', 'string'],
        ]);

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val, str_starts_with($key, 'workflow_') ? 'workflow' : 'advantages');
        }

        return back()->with('success', 'Konten Keunggulan Layanan & Alur Kerja berhasil disimpan!');
    }
}

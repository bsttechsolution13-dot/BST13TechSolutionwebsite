<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the BST TechSolution landing page and service catalog.
     */
    public function index(): View
    {
        try {
            $settings = SiteSetting::allKeyed();
        } catch (\Throwable) {
            $settings = [];
        }

        $whatsappNumber = $settings['business_whatsapp'] ?? config('services.whatsapp.number', '6285861773230');

        $services = $this->getServicesData($whatsappNumber);

        $categories = array_values(array_unique(array_merge(['Semua'], array_column($services, 'category'))));

        $businessInfo = [
            'name' => $settings['business_name'] ?? 'BST TechSolution',
            'tagline' => $settings['business_tagline'] ?? 'Solusi Kebutuhan IT, Gadget, & Audio Terpercaya',
            'description' => $settings['business_description'] ?? 'Pusat layanan teknologi dan audio terpercaya. Melayani reparasi HP & laptop, rakit PC custom, pembuatan website, sewa sound system acara, hingga instalasi OS. Konsultasi langsung via WhatsApp cepat respon.',
            'whatsapp' => $whatsappNumber,
            'whatsapp_display' => $settings['business_whatsapp_display'] ?? '+62 858-6177-3230',
            'address' => $settings['business_address'] ?? 'Workshop BST13 Tech - Layanan Cepat & Janji Temu',
            'operating_hours' => $settings['business_operating_hours'] ?? 'Senin - Sabtu: 09.00 - 21.00 WIB (Fast Respon via WA)',
            'rating' => '4.9/5.0',
            'completed_projects' => '1.500+',
            'happy_clients' => '98%',
        ];

        $advantages = [
            [
                'index' => '01',
                'badge' => $settings['adv_1_badge'] ?? 'BONGKAR DI DEPAN ANDA',
                'title' => $settings['adv_1_title'] ?? 'Diagnosa Transparan & Terbuka',
                'description' => $settings['adv_1_desc'] ?? 'Unit diperiksa langsung di meja teknisi. Kerusakan IC, fleksibel, atau layar dijelaskan tanpa istilah membingungkan atau vonis palsu.',
                'point' => $settings['adv_1_point'] ?? 'Anti-tukar komponen asli',
                'color' => 'blue',
            ],
            [
                'index' => '02',
                'badge' => $settings['adv_2_badge'] ?? 'SPAREPART TERPILIH',
                'title' => $settings['adv_2_title'] ?? 'Suku Cadang Grade Ori & Bersegel',
                'description' => $settings['adv_2_desc'] ?? 'Komponen suku cadang lolos uji kestabilan voltase dan presisi fisik sebelum dipasang, memastikan perangkat awet jangka panjang.',
                'point' => $settings['adv_2_point'] ?? 'Segel garansi fisik terjamin',
                'color' => 'amber',
            ],
            [
                'index' => '03',
                'badge' => $settings['adv_3_badge'] ?? 'TEKNISI LANGSUNG',
                'title' => $settings['adv_3_title'] ?? 'Diskusi WhatsApp Tanpa Bot Kaku',
                'description' => $settings['adv_3_desc'] ?? 'Setiap chat dijawab langsung oleh teknisi yang mengerti kendala teknis. Bebas tanya keluhan, solusi alternatif, atau estimasi waktu.',
                'point' => $settings['adv_3_point'] ?? 'Respon ramah & solutif',
                'color' => 'purple',
            ],
            [
                'index' => '04',
                'badge' => $settings['adv_4_badge'] ?? 'GARANSI & BEBAS RISIKO',
                'title' => $settings['adv_4_title'] ?? 'Batal Periksa Bebas Biaya (Rp 0)',
                'description' => $settings['adv_4_desc'] ?? 'Jika setelah dicek Anda merasa belum ingin melanjutkan perbaikan, unit kami pasang rapi kembali tanpa ditarik biaya cek awal.',
                'point' => $settings['adv_4_point'] ?? 'Garansi pengerjaan & nota jelas',
                'color' => 'emerald',
            ],
        ];

        $workflowSteps = [
            [
                'step' => '01',
                'title' => $settings['workflow_1_title'] ?? 'Pilih Layanan di Web',
                'description' => $settings['workflow_1_desc'] ?? 'Klik tombol Pesan pada kartu layanan untuk mengisi form otomatis.',
            ],
            [
                'step' => '02',
                'title' => $settings['workflow_2_title'] ?? 'Konsultasi via WhatsApp',
                'description' => $settings['workflow_2_desc'] ?? 'Diskusikan gejala kerusakan atau kebutuhan acara bersama teknisi.',
            ],
            [
                'step' => '03',
                'title' => $settings['workflow_3_title'] ?? 'Pengerjaan & Pengecekan',
                'description' => $settings['workflow_3_desc'] ?? 'Bawa unit ke workshop, tunggu di tempat atau kirim brief pengerjaan.',
            ],
            [
                'step' => '04',
                'title' => $settings['workflow_4_title'] ?? 'Uji Fungsi & Bergaransi',
                'description' => $settings['workflow_4_desc'] ?? 'Cek bersama hingga puas sebelum pelunasan dan serah terima nota garansi.',
            ],
        ];

        $testimonials = [
            [
                'name' => 'Fajar Pratama',
                'role' => 'Content Creator',
                'service' => 'Rakit Komputer & Install OS',
                'rating' => 5,
                'comment' => 'Konsultasi rakit PC gaming & editing sangat jelas. Part disesuaikan dengan budget, kabel rapi banget, dan performa stabil!',
            ],
            [
                'name' => 'Rina Andriani',
                'role' => 'Mahasiswi',
                'service' => 'Reparasi Laptop & Ganti Keyboard',
                'rating' => 5,
                'comment' => 'Laptop overheat parah dan tombol spasi macet. Pengerjaan cepat, thermal paste diganti yang bagus, laptop adem lagi.',
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Pemilik Toko Retail',
                'service' => 'Pembuatan Website Bisnis',
                'rating' => 5,
                'comment' => 'Website toko online selesai tepat waktu, tampilannya rapi di HP, dan customer langsung terhubung ke WhatsApp kami.',
            ],
            [
                'name' => 'Dimas Arya',
                'role' => 'Ketua Panitia Acara Musik',
                'service' => 'Sewa Sound Paket Event',
                'rating' => 5,
                'comment' => 'Sound system mantap bass-nya bulat, mic wireless jernih tanpa distorsi. Operator standby dari awal sampai acara selesai.',
            ],
        ];

        return view('home', compact(
            'services',
            'categories',
            'businessInfo',
            'advantages',
            'workflowSteps',
            'testimonials',
            'settings'
        ));
    }

    /**
     * Handle quick consultation form and redirect directly to WhatsApp with pre-filled message.
     */
    public function consult(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:25',
            'service' => 'required|string|max:100',
            'message' => 'nullable|string|max:500',
        ]);

        try {
            $settings = SiteSetting::allKeyed();
        } catch (\Throwable) {
            $settings = [];
        }

        $whatsappNumber = $settings['business_whatsapp'] ?? config('services.whatsapp.number', '6285861773230');

        $text = "Halo BST TechSolution,\n\n";
        $text .= "Saya ingin konsultasi/pesan layanan dari website:\n";
        $text .= "• Nama: {$validated['name']}\n";
        if (! empty($validated['phone'])) {
            $text .= "• Kontak/No. HP: {$validated['phone']}\n";
        }
        $text .= "• Layanan: {$validated['service']}\n";
        if (! empty($validated['message'])) {
            $text .= "• Keterangan/Kendala: {$validated['message']}\n\n";
        } else {
            $text .= "\n";
        }
        $text .= 'Bisa dibantu info lebih lanjut dan penanganannya? Terima kasih!';

        $waUrl = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode($text);

        return redirect()->away($waUrl);
    }

    /**
     * Direct WhatsApp redirect for a specific service slug.
     */
    public function redirectService(string $slug): RedirectResponse
    {
        try {
            $settings = SiteSetting::allKeyed();
        } catch (\Throwable) {
            $settings = [];
        }

        $whatsappNumber = $settings['business_whatsapp'] ?? config('services.whatsapp.number', '6285861773230');
        $services = collect($this->getServicesData($whatsappNumber));

        $service = $services->firstWhere('slug', $slug);

        if (! $service) {
            return redirect()->route('home');
        }

        return redirect()->away($service['whatsapp_url']);
    }

    /**
     * Get the master list of services (loaded dynamically from database with fallback).
     *
     * @return array<int, array<string, mixed>>
     */
    private function getServicesData(string $whatsappNumber): array
    {
        try {
            $dbServices = Service::where('is_active', true)->orderBy('sort_order')->get();
        } catch (\Throwable) {
            $dbServices = collect();
        }

        if ($dbServices->isNotEmpty()) {
            return $dbServices->map(function (Service $service) use ($whatsappNumber) {
                $template = "Halo BST TechSolution,\n\nSaya ingin memesan layanan *{$service->title}* dari website Anda.\nBoleh minta info paket, estimasi waktu, dan konsultasi kebutuhan saya?";
                $encodedText = rawurlencode($template);

                return [
                    'id' => $service->id,
                    'slug' => $service->slug,
                    'title' => $service->title,
                    'category' => $service->category,
                    'icon' => $service->icon ?: 'wrench-screwdriver',
                    'badge' => $service->badge,
                    'short_description' => $service->description,
                    'features' => $service->features ?? [],
                    'whatsapp_message_template' => $template,
                    'whatsapp_url' => "https://wa.me/{$whatsappNumber}?text={$encodedText}",
                ];
            })->all();
        }

        return [];
    }
}

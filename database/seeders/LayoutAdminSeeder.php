<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LayoutAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin Layout User
        User::updateOrCreate(
            ['email' => 'admin@bst13.com'],
            [
                'name' => 'Admin Layout BST13',
                'password' => Hash::make('admin123'),
                'role' => 'admin_layout',
            ]
        );

        // 2. Default Site Settings for Layout & Content
        $settings = [
            // Hero Section
            'hero_headline' => 'Solusi Kebutuhan IT, Gadget & Audio dalam Satu Tempat.',
            'hero_subheadline' => 'Melayani servis HP & laptop, rakit PC custom, pembuatan website bisnis, sewa sound system acara, hingga instalasi OS. Konsultasikan kendala Anda langsung dengan teknisi kami via WhatsApp.',
            'hero_badge' => 'Workshop & Layanan Terpercaya',
            'hero_bg_image' => 'images/backgrounds/hero-tech-workshop.jpg',
            'hero_bg_opacity' => '35',
            'hero_cta_text' => 'Pilih Layanan & Pesan',
            'hero_trust_1' => 'Konsultasi Bebas Biaya',
            'hero_trust_2' => 'Diagnosa Terbuka & Jujur',
            'hero_trust_3' => 'Garansi Pengerjaan Nyata',

            // Hero Card Right
            'hero_card_title' => 'Meja Konsultasi BST13',
            'hero_card_subtitle' => 'Respon Cepat & Pengecekan Ramah',
            'hero_card_point_1_title' => 'Pilih Layanan, Formulir Langsung Terisi',
            'hero_card_point_1_desc' => 'Pijit tombol pada kartu layanan mana pun, form langsung terisi otomatis.',
            'hero_card_point_2_title' => 'Bisa Ditunggu / Janji Temu',
            'hero_card_point_2_desc' => 'Ganti baterai, LCD, dan install OS dapat ditunggu di workshop.',
            'hero_card_point_3_title' => 'Tanpa Biaya Sebelum Disepakati',
            'hero_card_point_3_desc' => 'Pemeriksaan unit dan estimasi biaya dikonfirmasi terlebih dahulu.',

            // Brand & Info
            'business_name' => 'BST TechSolution',
            'business_tagline' => 'Solusi Kebutuhan IT, Gadget, & Audio Terpercaya',
            'business_description' => 'Pusat layanan teknologi dan audio terpercaya. Melayani reparasi HP & laptop, rakit PC custom, pembuatan website, sewa sound system acara, hingga instalasi OS. Konsultasi langsung via WhatsApp cepat respon.',
            'business_whatsapp' => '6285861773230',
            'business_whatsapp_display' => '+62 858-6177-3230',
            'business_address' => 'Workshop BST13 Tech - Layanan Cepat & Janji Temu',
            'business_operating_hours' => 'Senin - Sabtu: 09.00 - 21.00 WIB (Fast Respon via WA)',
            'brand_logo' => 'images/logo-circle.png',

            // Keunggulan & Layanan Kami
            'advantages_eyebrow' => 'Keunggulan Layanan Kami',
            'advantages_title' => 'Keunggulan Layanan BST TechSolution',
            'advantages_subtitle' => 'Kami berkomitmen memberikan pelayanan yang jujur, transparan, dan tidak merepotkan Anda.',

            // Card 1
            'adv_1_badge' => 'Diagnosa Terbuka',
            'adv_1_title' => 'Cek & Diagnosa Transparan',
            'adv_1_desc' => 'Pengecekan unit dilakukan terbuka di depan pelanggan. Kerusakan dan opsi perbaikan dijelaskan secara jujur sebelum pengerjaan.',
            'adv_1_point' => 'Pengecekan langsung di tempat',

            // Card 2
            'adv_2_badge' => 'Sparepart Teruji',
            'adv_2_title' => 'Sparepart Teruji & Berkualitas',
            'adv_2_desc' => 'Komponen suku cadang dipilih yang teruji kualitasnya untuk memastikan keawetan perangkat Anda setelah diperbaiki.',
            'adv_2_point' => 'Segel fisik terjamin',

            // Card 3
            'adv_3_badge' => 'Fast Respon',
            'adv_3_title' => 'Langsung Diskusi via WhatsApp',
            'adv_3_desc' => 'Tidak perlu ribet registrasi atau antre lama. Cukup klik pesan layanan, konsultasikan langsung dengan teknisi secara ramah.',
            'adv_3_point' => 'Konsultasi ramah teknisi',

            // Card 4
            'adv_4_badge' => 'Jaminan Servis',
            'adv_4_title' => 'Bergaransi Pengerjaan Nyata',
            'adv_4_desc' => 'Setiap pengerjaan hardware, instalasi software, maupun pembuatan website dilindungi jaminan garansi servis.',
            'adv_4_point' => 'Garansi pengerjaan & nota jelas',

            // Alur / Cara Pesan
            'workflow_eyebrow' => 'Proses Mudah',
            'workflow_title' => 'Cara Pesan & Konsultasi',
            'workflow_subtitle' => 'Hanya butuh 4 langkah mudah untuk menyelesaikan kendala gadget atau kebutuhan acara Anda.',
            'workflow_1_title' => 'Pilih Layanan di Web',
            'workflow_1_desc' => 'Klik tombol Pesan pada kartu layanan untuk mengisi form otomatis.',
            'workflow_2_title' => 'Konsultasi via WhatsApp',
            'workflow_2_desc' => 'Diskusikan gejala kerusakan atau kebutuhan acara bersama teknisi.',
            'workflow_3_title' => 'Pengerjaan & Pengecekan',
            'workflow_3_desc' => 'Bawa unit ke workshop, tunggu di tempat atau kirim brief pengerjaan.',
            'workflow_4_title' => 'Uji Fungsi & Bergaransi',
            'workflow_4_desc' => 'Cek bersama hingga puas sebelum pelunasan dan serah terima nota garansi.',

            // Layout Toggles
            'show_hero_bg' => '1',
            'show_testimonials' => '1',
            'show_advantages' => '1',
            'show_workflow' => '1',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => str_starts_with($key, 'hero_') ? 'hero' : (str_starts_with($key, 'business_') ? 'business' : 'layout'),
                    'type' => is_numeric($value) ? (strlen($value) === 1 ? 'boolean' : 'integer') : 'text',
                ]
            );
        }

        // 3. Initial 9 Services Data
        $services = [
            [
                'slug' => 'pembuatan-website',
                'title' => 'Pembuatan Website',
                'category' => 'Web Development',
                'icon' => 'globe-alt',
                'badge' => 'Website & Sistem',
                'description' => 'Pembuatan web company profile, landing page promosi, toko online, hingga sistem web kustom responsif di HP dan laptop.',
                'features' => [
                    'Tampilan Modern & Mobile Friendly',
                    'Integrasi Langsung ke WhatsApp Bisnis',
                    'Optimasi Kecepatan & SEO Google',
                    'Panduan Penggunaan & Maintenance',
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'reparasi-handphone',
                'title' => 'Reparasi Handphone',
                'category' => 'Reparasi & Servis',
                'icon' => 'device-phone-mobile',
                'badge' => 'Android & iPhone',
                'description' => 'Servis HP ganti LCD touchscreen, penggantian baterai drop, konektor cas, kamera, speaker, hingga perbaikan mesin mati total.',
                'features' => [
                    'Pilihan Sparepart Berkualitas',
                    'Pengerjaan Rapi & Hati-hati',
                    'Bisa Ditunggu untuk Kerusakan Ringan',
                    'Garansi Penggantian Sparepart',
                ],
                'sort_order' => 2,
            ],
            [
                'slug' => 'reparasi-laptop',
                'title' => 'Reparasi Laptop',
                'category' => 'Reparasi & Servis',
                'icon' => 'computer-desktop',
                'badge' => 'Segala Merk',
                'description' => 'Perbaikan laptop lemot, ganti keyboard & LCD, perbaikan engsel patah, pembersihan kipas, ganti thermal paste, hingga service motherboard.',
                'features' => [
                    'Pembersihan Debu & Sirkulasi Panas',
                    'Thermal Paste Premium Anti-Overheat',
                    'Rekonstruksi Engsel Kuat & Presisi',
                    'Garansi Servis Motherboard',
                ],
                'sort_order' => 3,
            ],
            [
                'slug' => 'reparasi-komputer',
                'title' => 'Reparasi Komputer',
                'category' => 'Reparasi & Servis',
                'icon' => 'cpu-chip',
                'badge' => 'Hardware PC',
                'description' => 'Troubleshooting CPU tidak tampil (no display), sering restart/BSOD, penggantian power supply, VGA error, pembersihan total komponen.',
                'features' => [
                    'Pemeriksaan Tegangan Komponen',
                    'Deep Cleaning & Pembersihan Total',
                    'Pengujian Kestabilan Sistem',
                    'Perapian Jalur Kabel (Cable Management)',
                ],
                'sort_order' => 4,
            ],
            [
                'slug' => 'rakit-komputer',
                'title' => 'Rakit Komputer',
                'category' => 'Rakit PC',
                'icon' => 'wrench-screwdriver',
                'badge' => 'Custom Spek',
                'description' => 'Perakitan PC Gaming, PC Editing/Desain grafis, hingga PC Kantor/Kasir sesuai budget. Konsultasi part seimbang tanpa bottleneck.',
                'features' => [
                    'Konsultasi Spesifikasi Sesuai Budget',
                    'Pemilihan Part Resmi & Awet',
                    'Cable Management Bersih & Estetik',
                    'Sudah Termasuk Install OS & Uji Game/Software',
                ],
                'sort_order' => 5,
            ],
            [
                'slug' => 'sewa-sound-paket',
                'title' => 'Sewa Sound Paket',
                'category' => 'Sewa Audio',
                'icon' => 'speaker-wave',
                'badge' => 'Paket Event',
                'description' => 'Penyewaan sound system untuk hajatan, rapat, seminar kampus, acara syukuran, hingga pertunjukan live musik lengkap dengan operator teknisi.',
                'features' => [
                    'Speaker Bertenaga & Suara Jernih',
                    'Mic Wireless Bebas Dengung',
                    'Mixer Audio & Pengaturan Akustik',
                    'Didampingi Teknisi Audio Standby',
                ],
                'sort_order' => 6,
            ],
            [
                'slug' => 'jual-beli-handphone',
                'title' => 'Jual Beli Handphone',
                'category' => 'Jual Beli Gadget',
                'icon' => 'arrows-right-left',
                'badge' => 'Terima Jual & Beli',
                'description' => 'Terima jual handphone bekas dengan harga wajar dan jujur. Tersedia juga pilihan HP second layak pakai berkualitas yang siap digunakan.',
                'features' => [
                    'Pengecekan Fungsi Menyeluruh',
                    'Taksiran Harga Jujur Sesuai Kondisi',
                    'Unit Bebas Kendala Akun & IMEI',
                    'Garansi Toko untuk Unit Pembelian',
                ],
                'sort_order' => 7,
            ],
            [
                'slug' => 'install-ulang-laptop',
                'title' => 'Install Ulang Laptop',
                'category' => 'Install Ulang OS',
                'icon' => 'arrow-path',
                'badge' => 'Langsung Pakai',
                'description' => 'Install ulang Windows 10/11 atau Linux, instalasi driver lengkap, paket software office, PDF, browser, dan pembersihan virus laptop.',
                'features' => [
                    'Bantuan Pengamanan Data Penting',
                    'Driver Resmi Laptop Terinstall Lengkap',
                    'Paket Aplikasi Office & Kerja Siap Pakai',
                    'Sistem Bersih Anti Lelet & Bebas Bloatware',
                ],
                'sort_order' => 8,
            ],
            [
                'slug' => 'install-ulang-komputer',
                'title' => 'Install Ulang Komputer',
                'category' => 'Install Ulang OS',
                'icon' => 'server-stack',
                'badge' => 'Performa Segar',
                'description' => 'Fresh install OS komputer desktop, partisi penyimpanan optimal (SSD/HDD), update driver GPU & chipset, serta optimasi performa harian.',
                'features' => [
                    'Partisi Harddisk / SSD Rapi',
                    'Driver VGA & Motherboard Terkini',
                    'Optimasi Startup & Performa',
                    'Aplikasi Standar Kerja / Hiburan Lengkap',
                ],
                'sort_order' => 9,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData + ['is_active' => true]
            );
        }
    }
}

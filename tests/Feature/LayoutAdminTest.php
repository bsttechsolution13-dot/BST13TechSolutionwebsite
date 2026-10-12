<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LayoutAdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'Admin Layout',
            'email' => 'admin@bst13.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin_layout',
        ]);
    }

    /**
     * Test guest is redirected to admin login when accessing protected admin routes.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can login with valid credentials.
     */
    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@bst13.com',
            'password' => 'admin123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->adminUser);
    }

    /**
     * Test authenticated admin can view dashboard and hero editor.
     */
    public function test_authenticated_admin_can_view_dashboard_and_hero(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Overview');

        $heroResponse = $this->actingAs($this->adminUser)->get('/admin/hero');
        $heroResponse->assertStatus(200);
        $heroResponse->assertSee('Pengaturan Hero & Background Jasa');
    }

    /**
     * Test admin can update hero settings and background image.
     */
    public function test_admin_can_update_hero_settings_and_background(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/hero', [
            'hero_headline' => 'Solusi Servis Cepat & Profesional BST',
            'hero_subheadline' => 'Layanan teknologi terpercaya langsung dari teknisi berpengalaman.',
            'hero_badge' => 'Workshop Resmi BST Tech',
            'hero_cta_text' => 'Hubungi Teknisi Sekarang',
            'hero_trust_1' => 'Pengecekan Gratis',
            'hero_trust_2' => 'Teknisi Handal',
            'hero_trust_3' => 'Garansi Resmi',
            'hero_card_title' => 'Meja Servis Cepat',
            'hero_card_subtitle' => 'Konsultasi Langsung',
            'hero_card_point_1_title' => 'Cepat & Ramah',
            'hero_card_point_1_desc' => 'Pelayanan ramah untuk semua kendala.',
            'hero_card_point_2_title' => 'Bisa Ditunggu',
            'hero_card_point_2_desc' => 'Kerusakan ringan bisa ditunggu.',
            'hero_card_point_3_title' => 'Estimasi Jujur',
            'hero_card_point_3_desc' => 'Tanpa biaya tersembunyi.',
            'hero_bg_selection' => 'images/backgrounds/hero-tech-workshop.jpg',
            'hero_bg_opacity' => 45,
            'show_hero_bg' => '1',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $this->assertEquals('Solusi Servis Cepat & Profesional BST', SiteSetting::get('hero_headline'));
        $this->assertEquals('images/backgrounds/hero-tech-workshop.jpg', SiteSetting::get('hero_bg_image'));

        // Check that homepage reflects updated hero headline
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Solusi Servis Cepat');
    }

    /**
     * Test admin can create and update a service.
     */
    public function test_admin_can_create_and_update_service(): void
    {
        $createResponse = $this->actingAs($this->adminUser)->post('/admin/services', [
            'title' => 'Ganti Baterai iPhone & Android',
            'category' => 'Reparasi & Servis',
            'badge' => 'Bisa Ditunggu',
            'description' => 'Ganti baterai kualitas original dengan kesehatan baterai 100%.',
            'features' => "Pengerjaan 30 Menit\nGaransi Baterai 6 Bulan\nCek Arus Gratis",
        ]);

        $createResponse->assertStatus(302);
        $createResponse->assertRedirect('/admin/services');

        $service = Service::where('title', 'Ganti Baterai iPhone & Android')->first();
        $this->assertNotNull($service);
        $this->assertEquals('Reparasi & Servis', $service->category);
        $this->assertCount(3, $service->features);

        // Edit the service
        $updateResponse = $this->actingAs($this->adminUser)->put("/admin/services/{$service->id}", [
            'title' => 'Ganti Baterai HP Semua Merk',
            'category' => 'Reparasi & Servis',
            'badge' => 'Garansi 6 Bulan',
            'description' => 'Deskripsi baterai baru yang diperbarui.',
            'features' => "Pengerjaan Cepat\nGaransi 6 Bulan",
            'is_active' => '1',
        ]);

        $updateResponse->assertStatus(302);
        $this->assertEquals('Ganti Baterai HP Semua Merk', $service->fresh()->title);
    }

    /**
     * Test admin can view and update advantages and workflow settings.
     */
    public function test_admin_can_view_and_update_advantages(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/advantages');
        $response->assertStatus(200);
        $response->assertSee('Pengaturan Keunggulan');

        $updateResponse = $this->actingAs($this->adminUser)->post('/admin/advantages', [
            'advantages_eyebrow' => 'STANDAR TEKNISI OTENTIK',
            'advantages_title' => 'Kejujuran Meja Kerja Bengkel Kami',
            'advantages_subtitle' => 'Pengecekan tanpa rahasia di depan mata Anda.',
            'advantages_highlight_title' => 'Bongkar Langsung Tanpa Ditukar',
            'advantages_highlight_desc' => 'Teknisi profesional kami bekerja di hadapan Anda.',
            'advantages_highlight_bullet_1' => 'Cek tegangan multimeter terbuka',
            'advantages_highlight_bullet_2' => 'Estimasi sebelum pengerjaan',
            'advantages_highlight_bullet_3' => 'Segel tamper-proof bergaransi',
            'advantages_highlight_bullet_4' => 'Dokumentasi foto dan video jelas',
            'adv_1_badge' => 'TRANSPARAN',
            'adv_1_title' => 'Diagnosa Jujur',
            'adv_1_desc' => 'Tanpa vonis kerusakan palsu.',
            'adv_1_point' => 'Nol komponen ditukar',
            'adv_2_badge' => 'ORI GRADE A',
            'adv_2_title' => 'Part Original',
            'adv_2_desc' => 'Sparepart pilihan bergaransi.',
            'adv_2_point' => 'Segel fisik resmi',
            'adv_3_badge' => 'TEKNISI LANGSUNG',
            'adv_3_title' => 'Chat Tanpa Bot',
            'adv_3_desc' => 'Diskusi langsung dengan teknisi.',
            'adv_3_point' => 'Respon solutif cepat',
            'adv_4_badge' => 'GARANSI NYATA',
            'adv_4_title' => 'Batal Rp 0',
            'adv_4_desc' => 'Bebas biaya jika belum sepakat.',
            'adv_4_point' => 'Nota garansi tertulis',
            'workflow_eyebrow' => 'ALUR KERJA MUDAH',
            'workflow_title' => '4 Langkah Praktis',
            'workflow_subtitle' => 'Alur servis simpel tanpa antre panjang.',
            'workflow_1_title' => 'Pilih Layanan',
            'workflow_1_desc' => 'Pilih di web.',
            'workflow_2_title' => 'Konsultasi WA',
            'workflow_2_desc' => 'Chat teknisi.',
            'workflow_3_title' => 'Pengerjaan Unit',
            'workflow_3_desc' => 'Bawa ke workshop.',
            'workflow_4_title' => 'Cek & Garansi',
            'workflow_4_desc' => 'Uji bersama sebelum bayar.',
        ]);

        $updateResponse->assertStatus(302);
        $updateResponse->assertSessionHas('success');

        $this->assertEquals('STANDAR TEKNISI OTENTIK', SiteSetting::get('advantages_eyebrow'));
        $this->assertEquals('Kejujuran Meja Kerja Bengkel Kami', SiteSetting::get('advantages_title'));

        // Verify homepage shows the updated settings
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('STANDAR TEKNISI OTENTIK');
        $home->assertSee('Kejujuran Meja Kerja Bengkel Kami');
        $home->assertSee('Nol komponen ditukar');
    }
}

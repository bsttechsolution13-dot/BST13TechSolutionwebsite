<?php

namespace Tests\Feature;

use Database\Seeders\LayoutAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(LayoutAdminSeeder::class);
    }

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('BST');
        $response->assertSee('TechSolution');
        $response->assertSee('+62 858-6177-3230');

        // Check that all 9 service titles are present
        $response->assertSee('Pembuatan Website');
        $response->assertSee('Reparasi Handphone');
        $response->assertSee('Reparasi Laptop');
        $response->assertSee('Reparasi Komputer');
        $response->assertSee('Rakit Komputer');
        $response->assertSee('Sewa Sound Paket');
        $response->assertSee('Jual Beli Handphone');
        $response->assertSee('Install Ulang Laptop');
        $response->assertSee('Install Ulang Komputer');

        // Ensure prices are removed
        $response->assertDontSee('Mulai Rp');
        $response->assertDontSee('Rp 750.000');
    }

    /**
     * Test direct WhatsApp redirect for a valid service slug targets the new WhatsApp number.
     */
    public function test_service_whatsapp_redirect_works(): void
    {
        $response = $this->get('/layanan/pembuatan-website/whatsapp');

        $response->assertStatus(302);
        $this->assertStringContainsString('https://wa.me/6285861773230', $response->headers->get('Location'));
    }

    /**
     * Test consultation form submission redirects to WhatsApp with formatted text to new number.
     */
    public function test_consultation_form_submits_and_redirects_to_whatsapp(): void
    {
        $response = $this->post('/konsultasi', [
            'name' => 'Fulan',
            'phone' => '081234567890',
            'service' => 'Rakit Komputer',
            'message' => 'Mau konsultasi spek PC Gaming budget 10 juta.',
        ]);

        $response->assertStatus(302);
        $redirectUrl = $response->headers->get('Location');
        $this->assertStringContainsString('https://wa.me/6285861773230', $redirectUrl);
        $this->assertStringContainsString('Fulan', rawurldecode($redirectUrl));
        $this->assertStringContainsString('Rakit%20Komputer', $redirectUrl);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Balita;
use App\Models\Informasi;
use App\Models\Mpasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPublicDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_guest_landing_shows_empty_states_instead_of_fake_data(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Belum ada artikel kesehatan.')
            ->assertSee('Belum ada resep MPASI.')
            ->assertDontSee('12.4k+')
            ->assertDontSee('99.2%');
    }

    public function test_guest_can_read_real_database_content_and_open_details(): void
    {
        Balita::create([
            'nama_balita' => 'Data Privat Balita',
            'nik' => '1234567890123456',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2025-01-01',
        ]);
        $informasi = Informasi::create([
            'judul' => 'Panduan Anak Sehat',
            'category' => 'Edukasi',
            'summary' => 'Ringkasan yang berasal dari database.',
            'content' => 'Isi artikel yang berasal dari database.',
        ]);
        $resep = Mpasi::create([
            'nama_resep' => 'Bubur Wortel',
            'kategori_usia' => '6-8',
            'waktu_memasak' => 20,
            'porsi' => 2,
            'kalori' => 100,
            'protein' => 4,
            'bahan' => ['Beras 30 gr', 'Wortel 20 gr'],
            'cara_pembuatan' => ['Rebus hingga matang'],
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Panduan Anak Sehat')
            ->assertSee('Bubur Wortel')
            ->assertSee(route('public.informasi.show', $informasi))
            ->assertSee(route('public.resep.show', $resep))
            ->assertDontSee('Data Privat Balita')
            ->assertDontSee('1234567890123456');

        $this->get(route('public.informasi.index'))->assertOk()->assertSee('Panduan Anak Sehat');
        $this->get(route('public.informasi.show', $informasi))->assertOk()->assertSee('Isi artikel yang berasal dari database.');
        $this->get(route('public.resep.index'))->assertOk()->assertSee('Bubur Wortel');
        $this->get(route('public.resep.show', $resep))->assertOk()->assertSee('Rebus hingga matang')->assertSee('Wortel 20 gr');
    }

    public function test_unknown_public_details_return_404(): void
    {
        $this->get(route('public.informasi.show', 999999))->assertNotFound();
        $this->get(route('public.resep.show', 999999))->assertNotFound();
    }
}

<?php

namespace Tests\Feature;

use App\Models\Balita;
use App\Models\Informasi;
use App\Models\Pengukuran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiInformasiDanPengukuranTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_informasi_without_login(): void
    {
        $this->getJson(route('api.informasi.index'))
            ->assertUnauthorized();

        $this->getJson(route('api.informasi.categories'))
            ->assertUnauthorized();
    }

    public function test_authenticated_user_can_access_informasi_and_filter(): void
    {
        $user = User::factory()->create(['role' => 'Orang Tua']);
        Sanctum::actingAs($user);

        $info1 = Informasi::create([
            'judul' => 'Nutrisi Penting Trimester 1',
            'category' => 'Trimester 1',
            'summary' => 'Ringkasan artikel trimester 1',
            'content' => 'Konten lengkap trimester 1',
            'thumbnail' => '/storage/informasi/test1.jpg',
        ]);

        $info2 = Informasi::create([
            'judul' => 'Pencegahan Stunting Pada Anak',
            'category' => 'Pencegahan Stunting',
            'summary' => 'Tips mencegah stunting',
            'content' => 'Konten lengkap pencegahan stunting',
        ]);

        // Categories
        $catResponse = $this->getJson(route('api.informasi.categories'));
        $catResponse->assertOk()
            ->assertJsonStructure(['data']);

        // List all
        $listResponse = $this->getJson(route('api.informasi.index'));
        $listResponse->assertOk()
            ->assertJsonCount(2, 'data');

        // Filter category
        $filterResponse = $this->getJson(route('api.informasi.index', ['category' => 'Trimester 1']));
        $filterResponse->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id_informasi', $info1->id_informasi);

        // Search query
        $searchResponse = $this->getJson(route('api.informasi.index', ['q' => 'mencegah']));
        $searchResponse->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id_informasi', $info2->id_informasi);

        // Detail
        $detailResponse = $this->getJson(route('api.informasi.show', $info1));
        $detailResponse->assertOk()
            ->assertJsonPath('data.id_informasi', $info1->id_informasi)
            ->assertJsonPath('data.content', 'Konten lengkap trimester 1')
            ->assertJsonPath('data.thumbnail_url', url('storage/informasi/test1.jpg'));
    }

    public function test_pengukuran_calculates_using_owned_balita_data_and_is_not_saved_to_database(): void
    {
        $user = User::factory()->create(['role' => 'Orang Tua']);
        Sanctum::actingAs($user);

        $balita = Balita::create([
            'user_id' => $user->id,
            'nama_balita' => 'Balita Ku',
            'nik' => '3509010101250001',
            'tanggal_lahir' => now()->subMonths(12)->toDateString(),
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $this->assertEquals(0, Pengukuran::count());

        $response = $this->postJson(route('api.pengukuran.hitung'), [
            'balita_id' => $balita->id_balita,
            'tanggal_pengukuran' => now()->toDateString(),
            'berat_badan' => 9.5,
            'tinggi_badan' => 75.7,
            'posisi_badan' => 'terlentang',
            'lingkar_kepala' => 46.0,
            'lila' => 15.0,
        ]);

        $response->assertOk()
            ->assertJsonPath('disimpan', false)
            ->assertJsonPath('balita.id_balita', $balita->id_balita)
            ->assertJsonPath('balita.nama_balita', 'Balita Ku')
            ->assertJsonPath('balita.usia_bulan', 12)
            ->assertJsonStructure([
                'message',
                'disimpan',
                'balita' => [
                    'id_balita',
                    'nama_balita',
                    'nik',
                    'tanggal_lahir',
                    'jenis_kelamin',
                    'usia_bulan',
                ],
                'pengukuran' => [
                    'tanggal_pengukuran',
                    'berat_badan',
                    'tinggi_badan',
                    'posisi_badan',
                    'lingkar_kepala',
                    'lila',
                ],
                'hasil' => [
                    'status_stunting',
                    'badge_color',
                    'indikator_tinggi',
                    'z_score_tbu',
                    'status_berat_badan',
                    'z_score_bbu',
                    'status_gizi',
                    'indikator_berat_tinggi',
                    'z_score_bbtb',
                ],
            ]);

        // Verifikasi penting: data benar-benar TIDAK disimpan ke database
        $this->assertEquals(0, Pengukuran::count());
    }

    public function test_parent_cannot_calculate_for_other_parent_balita(): void
    {
        $parent1 = User::factory()->create(['role' => 'Orang Tua']);
        $parent2 = User::factory()->create(['role' => 'Orang Tua']);

        $balitaParent2 = Balita::create([
            'user_id' => $parent2->id,
            'nama_balita' => 'Balita Tetangga',
            'nik' => '3509010101250002',
            'tanggal_lahir' => now()->subMonths(15)->toDateString(),
            'jenis_kelamin' => 'Perempuan',
        ]);

        Sanctum::actingAs($parent1);

        // Parent 1 mencoba hitung status gizi balita milik Parent 2
        $response = $this->postJson(route('api.pengukuran.hitung'), [
            'balita_id' => $balitaParent2->id_balita,
            'tanggal_pengukuran' => now()->toDateString(),
            'berat_badan' => 10.0,
            'tinggi_badan' => 78.0,
            'posisi_badan' => 'terlentang',
        ]);

        $response->assertUnprocessable();
        $this->assertEquals(0, Pengukuran::count());
    }
}

<?php

namespace Database\Seeders;

use App\Models\Mpasi;
use Illuminate\Database\Seeder;

class MpasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $recipes =
        // [
        //     [
        //         'nama_resep' => 'Bubur Tim Salmon Beras Merah & Bayam Papuma',
        //         'kategori_usia' => '6-8',
        //         'waktu_memasak' => '25',
        //         'porsi' => 2,
        //         'kalori' => 185,
        //         'karbohidrat' => 22.5,
        //         'lemak' => 5.2,
        //         'protein' => 7.5,
        //         'zat_besi' => 2.8,
        //         'seng' => 1.5,
        //         'gambar' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '30 gr Beras Merah Organik Jember',
        //             '40 gr Fillet Ikan Salmon / Kembung Segar',
        //             '1 genggam Daun Bayam Segar Papuma',
        //             '1 sdt Minyak Kelapa / Lemak Tambahan',
        //         ],
        //         'cara_pembuatan' => [
        //             'Cuci beras merah hingga bersih, rebus dalam 300 ml kaldu sampai menjadi bubur lembut.',
        //             'Kukus fillet ikan dan bayam hingga matang merata tanpa garam/gula berlebih.',
        //             'Campurkan seluruh bahan ke dalam mangkuk, saring melalui kawat saring halus untuk bayi 6-8 bulan.',
        //         ],
        //     ],
        //     [
        //         'nama_resep' => 'Nasi Tim Ayam Kampung Suwir Labu Kuning Jember',
        //         'kategori_usia' => '9-11',
        //         'waktu_memasak' => '30',
        //         'porsi' => 3,
        //         'kalori' => 210,
        //         'karbohidrat' => 28.0,
        //         'lemak' => 6.0,
        //         'protein' => 8.8,
        //         'zat_besi' => 3.1,
        //         'seng' => 1.8,
        //         'gambar' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '50 gr Beras Putih Lokal Jember',
        //             '40 gr Daging Dada Ayam Kampung Cincang',
        //             '30 gr Labu Kuning Kukus Potong Dadu',
        //             '1/2 sdm Minyak Zaitun / Margarin',
        //         ],
        //         'cara_pembuatan' => [
        //             'Masak beras dengan kaldu ayam kampung hingga menjadi nasi tim lembek.',
        //             'Tumis ayam kampung cincang dengan sedikit margarin hingga harum dan matang.',
        //             'Masukkan labu kuning cincang, aduk bersama nasi tim hingga tekstur cincang kasar siap disajikan.',
        //         ],
        //     ],
        //     [
        //         'nama_resep' => 'Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger',
        //         'kategori_usia' => '12-23',
        //         'waktu_memasak' => '35',
        //         'porsi' => 3,
        //         'kalori' => 245,
        //         'karbohidrat' => 30.0,
        //         'lemak' => 6.5,
        //         'protein' => 11.2,
        //         'zat_besi' => 3.5,
        //         'seng' => 2.0,
        //         'gambar' => 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '60 gr Daging Ikan Tenggiri Giling TPI Puger',
        //             '1 butir Telur Puyuh Rebus',
        //             '30 gr Wortel & Jagung Manis Pipil',
        //             '250 ml Kaldu Sayur Asli',
        //         ],
        //         'cara_pembuatan' => [
        //             'Bentuk daging ikan tenggiri menjadi bulatan kecil seukuran suapan balita.',
        //             'Rebus kuah kaldu sayur, masukkan wortel dan jagung hingga empuk.',
        //             'Masukkan bola-bola ikan hingga terapung dan matang, sajikan hangat dengan nasi keluarga.',
        //         ],
        //     ],
        //     [
        //         'nama_resep' => 'Purée Hati Sapi Organik & Labu Madu Halus',
        //         'kategori_usia' => '6-8',
        //         'waktu_memasak' => '20',
        //         'porsi' => 2,
        //         'kalori' => 170,
        //         'karbohidrat' => 18.5,
        //         'lemak' => 4.8,
        //         'protein' => 8.2,
        //         'zat_besi' => 4.2,
        //         'seng' => 2.5,
        //         'gambar' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '30 gr Hati Sapi Segar Organik',
        //             '40 gr Labu Madu Kukus',
        //             '20 gr Kentang Kukus',
        //             '1 sdt Unsalted Butter',
        //         ],
        //         'cara_pembuatan' => [
        //             'Rebus hati sapi bersama rempah aromatik hingga empuk dan tidak bau.',
        //             'Kukus labu madu dan kentang hingga lunak.',
        //             'Blender semua bahan hingga halus lembut, tambahkan unsalted butter selagi hangat.',
        //         ],
        //     ],
        //     [
        //         'nama_resep' => 'Nasi Lembek Ikan Kembung Suwir & Tahu Lembut',
        //         'kategori_usia' => '9-11',
        //         'waktu_memasak' => '25',
        //         'porsi' => 2,
        //         'kalori' => 195,
        //         'karbohidrat' => 24.0,
        //         'lemak' => 5.5,
        //         'protein' => 9.1,
        //         'zat_besi' => 3.0,
        //         'seng' => 1.6,
        //         'gambar' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '40 gr Beras Putih Masak Lembek',
        //             '40 gr Ikan Kembung Segar Kukus Suwir Kasar',
        //             '20 gr Tahu Putih Lembut Potong Dadu',
        //             '1 sdt Minyak Kelapa',
        //         ],
        //         'cara_pembuatan' => [
        //             'Kukus ikan kembung hingga matang, suwir kasar dan pastikan bebas duri.',
        //             'Campurkan ke dalam panci nasi lembek bersama potongan tahu putih.',
        //             'Aduk merata dengan api kecil hingga bumbu menyatu, sajikan hangat.',
        //         ],
        //     ],
        //     [
        //         'nama_resep' => 'Nasi Tim Semur Telur Puyuh & Tempe Kukus Jember',
        //         'kategori_usia' => '12-23',
        //         'waktu_memasak' => '30',
        //         'porsi' => 2,
        //         'kalori' => 230,
        //         'karbohidrat' => 26.5,
        //         'lemak' => 6.2,
        //         'protein' => 10.4,
        //         'zat_besi' => 3.2,
        //         'seng' => 1.9,
        //         'gambar' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80',
        //         'bahan' => [
        //             '50 gr Nasi Tim',
        //             '3 butir Telur Puyuh Rebus Kupas',
        //             '30 gr Tempe Kedelai Jember Kukus Cincang',
        //             '1 sdt Kecap Manis Rendah Gula',
        //         ],
        //         'cara_pembuatan' => [
        //             'Kukus tempe kedelai hingga empuk lalu potong dadu kecil.',
        //             'Masak kuah semur manis ringan bersama telur puyuh dan tempe kukus.',
        //             'Siram kuah dan lauk di atas nasi tim hangat balita.',
        //         ],
        //     ],
        // ];

        // foreach ($recipes as $data) {
        //     Mpasi::create($data);
        // }
    }
}

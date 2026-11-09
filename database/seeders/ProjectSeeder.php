<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        Project::insert([
            [
                'title' => 'Website Wisata Lombok Timur',
                'description' => 'Website informasi destinasi wisata Lombok Timur lengkap dengan kategori, detail tempat, dan peta lokasi. Dibuat untuk mempromosikan wisata daerah.',
                'tech_stack' => 'Laravel, MySQL, Tailwind CSS',
                'demo_url' => null,
                'github_url' => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Aplikasi Kasir UMKM',
                'description' => 'Aplikasi kasir sederhana untuk usaha kecil: kelola produk, transaksi penjualan, stok, dan laporan harian.',
                'tech_stack' => 'Laravel, MySQL, Bootstrap',
                'demo_url' => null,
                'github_url' => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Sistem Informasi Akademik',
                'description' => 'Sistem pengelolaan data mahasiswa, mata kuliah, dan nilai dengan hak akses berbeda untuk admin dan dosen.',
                'tech_stack' => 'Laravel, MySQL, Blade',
                'demo_url' => null,
                'github_url' => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Aplikasi Catatan & To-Do',
                'description' => 'Aplikasi pencatat tugas harian dengan kategori, prioritas, dan pengingat tenggat waktu.',
                'tech_stack' => 'Laravel, JavaScript, SQLite',
                'demo_url' => null,
                'github_url' => null,
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }
}
<?php

/*
 * Data profil untuk halaman klasik (home, about, projects, contact).
 * Proyek TIDAK ditulis di sini: diambil dari tabel `projects` (lihat ProjectSeeder).
 * Landing page baru memakai config/portfolio.php, bukan file ini.
 */
return [
    'name'      => 'ALFA',
    'short'     => 'Alfa',
    'full_name' => 'Alfa Mahmud Khair',
    'role'      => 'Informatics Student | Aspiring Software Developer',
    'roles'     => ['Flutter Developer', 'Web Developer', 'Game Maker', 'Lifelong Learner'],
    'tagline'   => 'Mahasiswa Informatika yang membangun aplikasi mobile, website, dan game.',
    'status'    => 'Terbuka untuk proyek & kolaborasi',
    'available' => true,
    'location'  => 'Bandar Lampung, Indonesia',
    'campus'    => 'Universitas Teknokrat Indonesia',
    'campus_short' => 'UTI',
    'study'     => 'Informatika',
    'semester'  => 4,

    'intro' => 'Saya mahasiswa Informatika Universitas Teknokrat Indonesia asal Lombok Timur. '
             . 'Fokus saya pada web development, aplikasi mobile, dan UI engineering. '
             . 'Saya belajar paling cepat dengan membangun proyek nyata.',

    // Cek dan ganti dengan milikmu
    'email'     => 'alfamahmudkhair@teknokrat.ac.id',
    'whatsapp'  => 'https://wa.me/6281234567890',
    'whatsapp_label' => '+62 812 3456 7890',
    'github'    => 'https://github.com/alfamahmudkhair015-cyber',
    'linkedin'  => 'https://www.linkedin.com/in/username',
    'instagram' => 'https://www.instagram.com/alfa_alkhairi',
    'youtube'   => '',

    // Foto: ganti ke 'images/foto.png' kalau sudah punya versi tanpa latar
    'photo'     => 'images/foto.jpg',
    // CV: taruh PDF di public/files/cv-alfa.pdf (tombol muncul otomatis)
    'cv'        => 'files/cv-alfa.pdf',

    // value harus angka (dipakai animasi hitung), suffix ditampilkan setelahnya
    'stats' => [
        ['value' => 4, 'suffix' => '+', 'label' => 'Proyek Dikerjakan'],
        ['value' => 1, 'suffix' => '+', 'label' => 'Tahun Belajar'],
        ['value' => 12, 'suffix' => '+', 'label' => 'Teknologi Dipakai'],
    ],

    'services' => [
        ['icon' => '📱', 'title' => 'Aplikasi Mobile',
         'desc' => 'Membangun aplikasi Android/iOS dengan Flutter dan Firebase.'],
        ['icon' => '🌐', 'title' => 'Pengembangan Web',
         'desc' => 'Website dan sistem informasi dengan Laravel, MySQL, dan Tailwind CSS.'],
        ['icon' => '🎮', 'title' => 'Game Edukasi',
         'desc' => 'Game sederhana berbasis Construct 2 dan JavaScript untuk pembelajaran.'],
    ],

    'values' => [
        ['title' => 'Rasa Ingin Tahu', 'desc' => 'Selalu mencoba teknologi baru dan mencari tahu cara kerjanya.'],
        ['title' => 'Belajar dari Proses', 'desc' => 'Proses selalu lebih penting daripada hasil.'],
        ['title' => 'Rapi & Terstruktur', 'desc' => 'Kode yang mudah dibaca dan dirawat oleh orang lain.'],
    ],

    // level = persentase penguasaan (0-100). Ini nilai awal: sesuaikan dengan kemampuanmu.
    'skills' => [
        'Mobile' => [
            ['name' => 'Flutter',  'level' => 70],
            ['name' => 'Dart',     'level' => 65],
            ['name' => 'Firebase', 'level' => 60],
        ],
        'Web' => [
            ['name' => 'Laravel',  'level' => 70],
            ['name' => 'PHP',      'level' => 70],
            ['name' => 'Tailwind CSS', 'level' => 65],
            ['name' => 'JavaScript', 'level' => 60],
        ],
        'Tools' => [
            ['name' => 'Git & GitHub', 'level' => 65],
            ['name' => 'MySQL',        'level' => 60],
            ['name' => 'Figma',        'level' => 50],
        ],
    ],

    'education' => [
        ['period' => '2025 - Sekarang', 'title' => 'S1 Informatika',
         'place' => 'Universitas Teknokrat Indonesia',
         'desc' => 'Aktif dalam perkuliahan, mengerjakan berbagai project, dan mengembangkan skill pemrograman.'],
        ['period' => '2026', 'title' => 'Project Pribadi',
         'place' => 'Mandiri',
         'desc' => 'Membangun aplikasi mobile, website, dan game sebagai bahan belajar.'],
    ],
];

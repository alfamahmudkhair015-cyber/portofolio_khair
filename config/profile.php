<?php

return [
    'name'      => 'ALFA',
    'full_name' => 'Alfa Mahmud Khair',
    'available' => true,
    'campus'    => 'Universitas Teknokrat Indonesia',
    'campus_short' => 'UTI',
    'study'     => 'Informatika',
    'semester'  => 4,
    'location'  => 'Bandar Lampung, Indonesia',

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

    'stats' => [
        ['value' => null, 'label' => 'Projects Completed'], // null = dihitung otomatis dari daftar proyek
        ['value' => '1+', 'label' => 'Years Learning'],
        ['value' => '∞',  'label' => 'Always Exploring'],
    ],

    // 'url' kosong = ikon panah nonaktif. Isi dengan link demo/GitHub.
    'projects' => [
        ['key' => 'arunika', 'title' => 'ARUNIKA', 'desc' => 'Aplikasi pemesanan tiket desa wisata',
         'stack' => ['Flutter', 'Firebase'], 'url' => ''],
        ['key' => 'kasirku', 'title' => 'Kasirku', 'desc' => 'Aplikasi kasir modern',
         'stack' => ['Flutter', 'Dart'], 'url' => ''],
        ['key' => 'web', 'title' => 'Portofolio Web', 'desc' => 'Website portofolio pribadi',
         'stack' => ['Laravel', 'HTML', 'CSS'], 'url' => ''],
        ['key' => 'game', 'title' => 'Game Edukasi SDGS 4', 'desc' => 'Game platformer (Construct 2)',
         'stack' => ['Construct 2', 'JavaScript'], 'url' => ''],
    ],

    // slug = nama ikon di simpleicons.org, color = hex tanpa #
    'skills' => [
        ['name' => 'Flutter',        'slug' => 'flutter',       'color' => '54C5F8'],
        ['name' => 'Laravel',        'slug' => 'laravel',       'color' => 'FF2D20'],
        ['name' => 'JavaScript',     'slug' => 'javascript',    'color' => 'F7DF1E'],
        ['name' => 'PHP',            'slug' => 'php',           'color' => '8892BF'],
        ['name' => 'MySQL',          'slug' => 'mysql',         'color' => '6CA6D6'],
        ['name' => 'Firebase',       'slug' => 'firebase',      'color' => 'FFCA28'],
        ['name' => 'Git',            'slug' => 'git',           'color' => 'F05032'],
        ['name' => 'Figma',          'slug' => 'figma',         'color' => 'F24E1E'],
        ['name' => 'VS Code',        'slug' => 'visualstudiocode', 'color' => '3B9CFF'],
        ['name' => 'Android Studio', 'slug' => 'androidstudio', 'color' => '3DDC84'],
        ['name' => 'Node.js',        'slug' => 'nodedotjs',     'color' => '5FA04E'],
        ['name' => 'Python',         'slug' => 'python',        'color' => '4B8BBE'],
    ],

    'journey' => [
        ['year' => '2025 - Sekarang', 'title' => 'Mahasiswa Informatika - UTI',
         'desc' => 'Aktif dalam perkuliahan, mengerjakan berbagai project, dan mengembangkan skill pemrograman.'],
        ['year' => '2026', 'title' => 'Project Pribadi',
         'desc' => 'Membangun project pribadi seperti aplikasi mobile, website, dan game.'],
        ['year' => 'Kegiatan', 'title' => 'Organisasi & Kegiatan',
         'desc' => 'Mengikuti berbagai kegiatan kampus dan organisasi untuk menambah pengalaman dan relasi.'],
    ],

    'quote' => ['text' => 'Proses selalu lebih penting daripada hasil.', 'by' => 'Alfa Mahmud Khair'],
];
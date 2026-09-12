<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'stats' => [
            ['label' => 'Total Koleksi Judul', 'value' => '15.420+'],
            ['label' => 'Anggota Terdaftar', 'value' => '3.850+'],
            ['label' => 'Koleksi Digital', 'value' => '4.200+'],
            ['label' => 'Kunjungan Harian', 'value' => '650+'],
        ],
        'categories' => [
            ['id' => 'tech', 'name' => 'Teknologi & Komputer', 'count' => '3.240 Buku'],
            ['id' => 'science', 'name' => 'Sains & Matematika', 'count' => '2.180 Buku'],
            ['id' => 'literature', 'name' => 'Sastra & Fiksi', 'count' => '4.510 Buku'],
            ['id' => 'business', 'name' => 'Bisnis & Ekonomi', 'count' => '1.920 Buku'],
            ['id' => 'history', 'name' => 'Sejarah & Sosial', 'count' => '1.670 Buku'],
            ['id' => 'philosophy', 'name' => 'Filsafat & Psikologi', 'count' => '1.250 Buku'],
        ],
        'featuredBooks' => [
            [
                'id' => 1,
                'title' => 'Clean Architecture: Panduan Praktis Struktur Perangkat Lunak',
                'author' => 'Robert C. Martin',
                'category' => 'Teknologi & Komputer',
                'year' => '2018',
                'available' => true,
                'callNumber' => '005.1 MAR c',
            ],
            [
                'id' => 2,
                'title' => 'Designing Data-Intensive Applications',
                'author' => 'Martin Kleppmann',
                'category' => 'Teknologi & Komputer',
                'year' => '2017',
                'available' => true,
                'callNumber' => '005.7 KLE d',
            ],
            [
                'id' => 3,
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'category' => 'Sejarah & Sosial',
                'year' => '2014',
                'available' => false,
                'callNumber' => '909 HAR s',
            ],
            [
                'id' => 4,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'category' => 'Sastra & Fiksi',
                'year' => '1980',
                'available' => true,
                'callNumber' => '899.221 TOE b',
            ],
            [
                'id' => 5,
                'title' => 'Filosofi Teras: Menemukan Kedamaian Mental',
                'author' => 'Henry Manampiring',
                'category' => 'Filsafat & Psikologi',
                'year' => '2018',
                'available' => true,
                'callNumber' => '188 MAN f',
            ],
            [
                'id' => 6,
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'category' => 'Filsafat & Psikologi',
                'year' => '2011',
                'available' => false,
                'callNumber' => '153.4 KAH t',
            ],
        ],
        'services' => [
            [
                'title' => 'Peminjaman & Pengembalian',
                'description' => 'Layanan sirkulasi koleksi fisik dengan kuota hingga 5 buku selama 14 hari kerja.',
            ],
            [
                'title' => 'Akses Repositori & E-Journal',
                'description' => 'Akses ribuan karya ilmiah, skripsi, tesis, dan jurnal nasional terakreditasi.',
            ],
            [
                'title' => 'Ruang Baca & Diskusi',
                'description' => 'Fasilitas ruang tenang individual dan ruang kolaborasi kelompok dengan fasilitas multimedia.',
            ],
            [
                'title' => 'Bimbingan Penelusuran Literatur',
                'description' => 'Konsultasi bersama pustakawan untuk penelusuran referensi riset dan tugas akhir.',
            ],
        ],
    ]);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard/Overview');
    })->name('dashboard');

    Route::get('/books', function () {
        return Inertia::render('Dashboard/Books');
    })->name('dashboard.books');

    Route::get('/borrowed', function () {
        return Inertia::render('Dashboard/Borrowed');
    })->name('dashboard.borrowed');

    Route::get('/manage-user', function () {
        return Inertia::render('Dashboard/ManageUser');
    })->name('dashboard.manage-user');
});

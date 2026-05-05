@extends('layouts.app')

@section('content')

@php
    $statistik = [
        ['judul' => 'Total Program', 'nilai' => 4, 'ikon' => '📊', 'warna' => '#be163d'],
        ['judul' => 'Total Target Dana', 'nilai' => 'Rp 155.000.000', 'ikon' => '💰', 'warna' => '#28a745'],
        ['judul' => 'Program Aktif', 'nilai' => 4, 'ikon' => '🔥', 'warna' => '#ffc107'],
        ['judul' => 'Program Mendesak', 'nilai' => 0, 'ikon' => '⚠️', 'warna' => '#dc3545'],
    ];
@endphp

<!-- HERO -->
<section class="hero">
    <div class="hero-konten">
        <h1>Bersama Kita Bisa Membantu Sesama</h1>
        <p>Kelola program donasi, data donatur, dan laporan keuangan dari satu tempat.</p>
        <a href="#" class="hero-btn">Mulai Donasi</a>
    </div>
</section>

<section class="section-statistik">
    @forelse($statistik as $item)
        <x-stat-card
            :judul="$item['judul']"
            :nilai="$item['nilai']"
            :ikon="$item['ikon']"
            :warna="$item['warna']"
        />
    @empty
        <p style="margin:20px;">Data tidak tersedia</p>
    @endforelse
</section>

<!-- FORM TAMBAH PROGRAM -->
<section class="section-form">
    <h2 id="form-judul">Tambah Program Donasi</h2>
    <form class="form-program" id="form-program">
        <div class="form-row">
            <div class="form-grup">
                <label>Nama Program</label>
                <input type="text" id="nama-program">
                <small class="pesan-error" id="error-nama"></small>
            </div>

            <div class="form-grup">
                <label>Kategori</label>
                <select id="kategori-program">
                    <option value="">-- Pilih Kategori --</option>
                    <option>Bencana Alam</option>
                    <option>Anak Yatim</option>
                    <option>Pendidikan</option>
                    <option>Masjid</option>
                    <option>Kesehatan</option>
                </select>
                <small class="pesan-error" id="error-kategori"></small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-grup">
                <label>Target Dana</label>
                <input type="number" id="target-dana">
                <small class="pesan-error" id="error-target"></small>
            </div>

            <div class="form-grup">
                <label>Tanggal Mulai</label>
                <input type="date" id="tanggal-mulai">
                <small class="pesan-error" id="error-tanggal"></small>
            </div>
        </div>

        <div class="form-tombol">
            <button type="submit" class="btn-simpan">Simpan Program</button>
            <button type="button" class="btn-batal" id="btn-batal">Batal</button>
        </div>
    </form>
</section>

<!-- PENCARIAN -->
<section class="section-cari">
    <h2>Cari Program Donasi</h2>
    <form class="form-cari">
        <input type="text" id="input-cari" class="input-cari" placeholder="Cari...">
        <select id="filter-kategori" class="select-cari">
            <option value="">Semua</option>
            <option>Bencana Alam</option>
            <option>Anak Yatim</option>
        </select>
        <button type="button" class="btn-cari" id="btn-cari">Cari</button>
        <button type="button" class="btn-reset" id="btn-reset-cari">Reset</button>
    </form>
</section>

<!-- WRAPPER -->
<section class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h3>Filter Donasi</h3>
        <p>Sidebar masih statis (nanti bisa dikembangkan)</p>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="konten">

        <!-- CARD -->
        <section>
            <h2>Program Donasi Aktif</h2>
            <div class="card-grid" id="card-grid"></div>
        </section>

        <!-- TABEL -->
        <section class="section-tabel">
            <h2>Daftar Program Donasi</h2>
            <table class="tabel-donatur">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Kategori</th>
                        <th>Target</th>
                        <th>Terkumpul</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody-program"></tbody>
            </table>
        </section>

    </main>

</section>

@push('scripts')
<script>
    console.log("Dashboard loaded");

    document.addEventListener("DOMContentLoaded", function () {
        console.log("Script khusus dashboard jalan");
    });
</script>
@endpush

@endsection



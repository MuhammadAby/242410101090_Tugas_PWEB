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

        <p>
            Kelola program donasi, data donatur,
            dan laporan keuangan dari satu tempat.
        </p>

        <a href="{{ route('program-donasi.index') }}"
           class="hero-btn">
            Lihat Program Donasi
        </a>
    </div>
</section>

<!-- STATISTIK -->
<section class="section-statistik">

    @forelse($statistik as $item)

        <x-stat-card
            :judul="$item['judul']"
            :nilai="$item['nilai']"
            :ikon="$item['ikon']"
            :warna="$item['warna']"
        />

    @empty

        <p style="margin:20px;">
            Data tidak tersedia
        </p>

    @endforelse

</section>

<!-- PENCARIAN -->
<section class="section-cari">

    <h2>Cari Program Donasi</h2>

    <form class="form-cari">

        <input
            type="text"
            id="input-cari"
            class="input-cari"
            placeholder="Cari program donasi..."
        >

        <select
            id="filter-kategori"
            class="select-cari"
        >
            <option value="">Semua Kategori</option>
            <option>Bencana Alam</option>
            <option>Anak Yatim</option>
            <option>Pendidikan</option>
            <option>Masjid</option>
            <option>Kesehatan</option>
        </select>

        <button
            type="button"
            class="btn-cari"
            id="btn-cari"
        >
            Cari
        </button>

        <button
            type="button"
            class="btn-reset"
            id="btn-reset-cari"
        >
            Reset
        </button>

    </form>

</section>

<!-- WRAPPER -->
<section class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <h3>Filter Donasi</h3>

        <p>
            Sidebar masih statis
            (nanti bisa dikembangkan)
        </p>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="konten">

        <!-- CARD PROGRAM -->
        <section>

            <h2>Program Donasi Aktif</h2>

            <div class="card-grid">

                @forelse($programs as $program)

                    <div class="card-donasi">

                        @if($program->gambar)
                            <img src="{{ asset('storage/' . $program->gambar) }}"
                                alt="{{ $program->nama }}"
                                class="gambar-card">
                        @endif

                        <h3>{{ $program->nama }}</h3>

                        <p>
                            Kategori:
                            {{ $program->kategori }}
                        </p>

                        <p>
                            Terkumpul:
                            Rp {{ number_format($program->terkumpul) }}
                        </p>

                        <a href="{{ route('program-donasi.show', $program->id) }}"
                        class="btn-donasi">
                            Lihat Detail
                        </a>

                    </div>

                @empty

                    <p>Program donasi belum tersedia</p>

                @endforelse

            </div>

        </section>

    </main>

</section>

@push('scripts')

<script>

    console.log("Dashboard loaded");

    document.addEventListener("DOMContentLoaded", function () {

        console.log("Script dashboard aktif");

    });

</script>

@endpush

@endsection

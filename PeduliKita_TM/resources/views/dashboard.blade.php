@extends('layouts.app')

@section('content')

@php
    $statistik = [
        ['judul' => 'Total Program', 'nilai' => 4, 'ikon' => '📊', 'warna' => '#be163d'],
        ['judul' => 'Total Target Dana', 'nilai' => 'Rp 155.000.000', 'ikon' => '💰', 'warna' => '#28a745'],
        ['judul' => 'Program Aktif', 'nilai' => 4, 'ikon' => '🔥', 'warna' => '#ffc107'],
    ];
@endphp

<!-- HERO -->
<section class="hero-modern">

    <div class="hero-text">

        <span class="badge">
            ❤️ PeduliKita
        </span>

        <h1>
            Bersama Kita Bisa
            <span>Membantu Sesama</span>
        </h1>

        <p>
            Temukan berbagai program donasi terpercaya
            dan berikan dampak nyata bagi mereka yang membutuhkan.
        </p>

        <div class="hero-actions">

            <a href="{{ route('program-donasi.index') }}"
               class="btn-primary">

                Lihat Program

            </a>

            <a href="#program"
               class="btn-secondary">

                Donasi Sekarang

            </a>

        </div>

    </div>

    <div class="hero-image">

        <img src="https://cdn-icons-png.flaticon.com/512/4256/4256900.png"
             alt="Donasi">

    </div>

</section>

<section class="info-grid">

    <div class="info-card">

        <div class="info-icon">
            🌤️
        </div>

        <div>

            <h3>Cuaca Surabaya</h3>

            <p id="cuaca-loading">
                Memuat data cuaca...
            </p>

            <div id="cuaca-data" style="display:none;">

                <p>
                    <strong>Suhu:</strong>
                    <span id="suhu"></span> °C
                </p>

                <p>
                    <strong>Kondisi:</strong>
                    <span id="deskripsi"></span>
                </p>

            </div>

        </div>

    </div>

    <div class="info-card">

        <div class="info-icon">
            👥
        </div>

        <div>

            <h3>Statistik Kunjungan</h3>

            <p>
                Total:
                <strong>{{ $kunjungan }}</strong>
            </p>

            <p>
                Pertama:
                {{ $pertama }}
            </p>

            <p>
                Terakhir:
                {{ $terakhir }}
            </p>

            <form action="{{ route('reset.kunjungan') }}"
                method="POST">

                @csrf

                <button class="reset-btn">

                    Reset Hitungan

                </button>

            </form>

        </div>

    </div>

</section>

<!-- STATISTIK -->
<section class="stats-modern">

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
<section id="program" class="program-section">

    <div class="section-title">

        <h2>Program Donasi Aktif</h2>

        <p>
            Pilih program yang ingin Anda dukung hari ini.
        </p>

    </div>

    <div class="program-grid">

        @forelse($programs as $program)

            @php
                $persentase = $program->target > 0
                    ? min(($program->terkumpul / $program->target) * 100, 100)
                    : 0;
            @endphp

            <div class="program-card">

                @if($program->gambar)

                    <img
                        src="{{ asset('storage/' . $program->gambar) }}"
                        alt="{{ $program->nama }}"
                        class="program-image"
                    >

                @else

                    <img
                        src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800"
                        alt="Donasi"
                        class="program-image"
                    >

                @endif

                <div class="program-content">

                    <span class="kategori">

                        {{ $program->kategori }}

                    </span>

                    <h3>

                        {{ $program->nama }}

                    </h3>

                    <div class="progress-info">

                        <span>

                            Rp {{ number_format($program->terkumpul) }}

                        </span>

                        <span>

                            {{ round($persentase) }}%

                        </span>

                    </div>

                    <div class="progress-bar">

                        <div
                            class="progress-fill"
                            style="width: {{ $persentase }}%;"
                        ></div>

                    </div>

                    <small>

                        Target:
                        Rp {{ number_format($program->target) }}

                    </small>

                    <a
                        href="{{ route('program-donasi.show', $program->id) }}"
                        class="detail-btn"
                    >

                        Lihat Detail →

                    </a>

                </div>

            </div>

        @empty

            <p>Program donasi belum tersedia.</p>

        @endforelse

    </div>

</section>

@push('scripts')

<script>

    console.log("Dashboard loaded");

    document.addEventListener("DOMContentLoaded", function () {

        console.log("Script dashboard aktif");

    });

</script>

@endpush

@push('scripts')
<script>
async function ambilCuaca() {

    const loading = document.getElementById('cuaca-loading');
    const dataBox = document.getElementById('cuaca-data');

    try {
        const response = await fetch('https://wttr.in/Surabaya?format=j1');
        const data = await response.json();

        const suhu = data.current_condition[0].temp_C;
        const deskripsi = data.current_condition[0].weatherDesc[0].value;

        document.getElementById('suhu').innerText = suhu;
        document.getElementById('deskripsi').innerText = deskripsi;

        loading.style.display = 'none';
        dataBox.style.display = 'block';

    } catch (error) {
        loading.innerText = "Gagal ambil data cuaca";
        console.error(error);
    }
}

document.addEventListener("DOMContentLoaded", ambilCuaca);
</script>
@endpush

<section class="testimonial-section">

    <h2>
        Apa Kata Donatur?
    </h2>

    <div class="testimonial-grid">

        <div class="testimonial-card">

            <p>
                "PeduliKita membuat proses donasi menjadi mudah dan transparan."
            </p>

            <strong>
                – Kavin
            </strong>

        </div>

        <div class="testimonial-card">

            <p>
                "Saya bisa membantu sesama hanya dalam beberapa klik."
            </p>

            <strong>
                – Abi
            </strong>

        </div>

        <div class="testimonial-card">

            <p>
                "Program-programnya sangat jelas dan terpercaya."
            </p>

            <strong>
                – Donatur
            </strong>

        </div>

    </div>

</section>

<style>

.hero-modern{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:40px;
    padding:80px 10%;
    min-height:70vh;
}

.hero-text{
    flex:1;
}

.badge{
    display:inline-block;
    background:#ffe4e6;
    color:#be163d;
    padding:8px 16px;
    border-radius:50px;
    font-weight:600;
    margin-bottom:20px;
}

.hero-text h1{
    font-size:52px;
    line-height:1.2;
    margin-bottom:20px;
}

.hero-text h1 span{
    color:#be163d;
}

.hero-text p{
    color:#666;
    line-height:1.8;
    margin-bottom:30px;
}

.hero-actions{
    display:flex;
    gap:15px;
}

.btn-primary{
    background:#be163d;
    color:white;
    padding:14px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

.btn-secondary{
    border:2px solid #be163d;
    color:#be163d;
    padding:14px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

.hero-image{
    flex:1;
    text-align:center;
}

.hero-image img{
    max-width:420px;
    width:100%;
}

@media(max-width:768px){

    .hero-modern{
        flex-direction:column;
        text-align:center;
    }

    .hero-actions{
        justify-content:center;
        flex-wrap:wrap;
    }

    .hero-text h1{
        font-size:36px;
    }

}

.program-section{
    padding:80px 10%;
    background:#fafafa;
}

.section-title{
    text-align:center;
    margin-bottom:50px;
}

.section-title h2{
    font-size:40px;
    margin-bottom:10px;
}

.section-title p{
    color:#777;
}

.program-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));
    gap:30px;
}

.program-card{
    background:white;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:all .3s ease;
}

.program-card:hover{
    transform:translateY(-10px);
}

.program-image{
    width:100%;
    height:220px;
    object-fit:cover;
}

.program-content{
    padding:25px;
}

.kategori{
    display:inline-block;
    background:#ffe4e6;
    color:#be163d;
    padding:6px 15px;
    border-radius:50px;
    font-size:14px;
    font-weight:600;
    margin-bottom:15px;
}

.program-content h3{
    margin-bottom:20px;
}

.progress-info{
    display:flex;
    justify-content:space-between;
    font-weight:600;
    margin-bottom:10px;
}

.progress-bar{
    height:10px;
    background:#eee;
    border-radius:50px;
    overflow:hidden;
    margin-bottom:15px;
}

.progress-fill{
    height:100%;
    background:#be163d;
    border-radius:50px;
}

.detail-btn{
    display:inline-block;
    margin-top:20px;
    color:#be163d;
    text-decoration:none;
    font-weight:600;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(350px,1fr));
    gap:25px;
    padding:40px 10%;
}

.info-card{
    background:white;
    border-radius:24px;
    padding:30px;
    display:flex;
    gap:20px;
    align-items:flex-start;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.info-icon{
    font-size:40px;
}

.reset-btn{
    margin-top:15px;
    background:#be163d;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:12px;
    cursor:pointer;
}

.stats-modern{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    padding:40px 10%;
}

.stats-modern > *{
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.testimonial-section{
    padding:80px 10%;
    text-align:center;
}

.testimonial-grid{
    margin-top:40px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

.testimonial-card{
    background:white;
    padding:30px;
    border-radius:24px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.testimonial-card p{
    color:#666;
    line-height:1.8;
    margin-bottom:20px;
}

</style>

@endsection

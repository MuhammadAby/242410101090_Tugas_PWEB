@extends('layouts.app')

@section('content')

<!-- HERO -->
<section id="hero" class="hero-modern">

    <div class="hero-text">

        <p class="hero-kicker">
            Transparansi Nyata,<br>
            Dampak Bersama.
        </p>

        <p class="hero-desc">

            Bergabunglah dalam inisiatif filantropi modern yang menjamin
            setiap donasi Anda tercatat, transparan, dan tepat sasaran.
            Membangun masa depan yang lebih baik, satu langkah terukur
            pada satu waktu.

        </p>

        <div id="program" class="hero-actions">

            <a id="program" class="btn-donasi">

                Donasi Sekarang

            </a>

        </div>

    </div>

    <div class="hero-image">

        <div class="hero-image-wrapper">

            <img src="{{ asset('images/Foto Dashboard.jpg') }}"
                 alt="PeduliKita">

        </div>

    </div>

</section>

<!-- TENTANG -->
<section id="tentang" class="tentang-section">

    <div class="tentang-content">

        <span class="section-label">Tentang Kami</span>

        <h2>
            Komitmen pada Transparansi Mutlak
        </h2>

        <p>

            PeduliKita lahir dari kebutuhan akan kepercayaan dalam berdonasi.
            Kami percaya bahwa setiap pemberi dana berhak mengetahui ke mana
            dan bagaimana dana mereka digunakan. Melalui teknologi
            pencatatan presisi tinggi dan pelaporan real-time, kami
            menjembatani niat baik Anda dengan dampak nyata yang terukur.

        </p>

    </div>

    <div class="tentang-grid">

        <div class="tentang-card">

            <div class="tentang-icon">👁️</div>

            <h3>100% Transparan</h3>

            <p>
                Setiap transaksi dicatat dan dapat diakses publik melalui
                portal laporan interaktif kami.
            </p>

        </div>

        <div class="tentang-card">

            <div class="tentang-icon">🎯</div>

            <h3>Tepat Sasaran</h3>

            <p>
                Validasi ketat memastikan bantuan disalurkan kepada mereka
                yang paling membutuhkan secara efisien.
            </p>

        </div>

        <div class="tentang-card">

            <div class="tentang-icon">🛡️</div>

            <h3>Keamanan Dana</h3>

            <p>
                Sistem keamanan tingkat tinggi melindungi setiap donasi
                Anda dari awal hingga disalurkan.
            </p>

        </div>

    </div>

</section>

<!-- PROGRAM -->
<section id="program" class="program-section">

    <div class="section-header">

        <div>

            <span class="section-label">Program Aktif</span>

            <h2>
                Pilih Dampak Anda
            </h2>

            <p>
                Pilih program yang ingin Anda dukung hari ini.
            </p>

        </div>

        <a href="{{ route('program-donasi.index') }}"
           class="lihat-semua">

            Lihat Semua →

        </a>

    </div>

    <div class="program-grid">

        @forelse($programs as $program)

            @php
                $persentase = $program->target > 0
                    ? min(($program->terkumpul / $program->target) * 100, 100)
                    : 0;
            @endphp

            <div class="program-card"

                data-id="{{ $program->id }}"
                data-nama="{{ $program->nama }}"
                data-kategori="{{ $program->kategori }}"
                data-deskripsi="{{ $program->deskripsi }}"
                data-target="{{ number_format($program->target,0,',','.') }}"
                data-terkumpul="{{ number_format($program->terkumpul,0,',','.') }}"
                data-gambar="{{ $program->gambar
                    ? asset('storage/'.$program->gambar)
                    : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800'
                }}"

            >

                <div class="program-image-wrap">

                    <img
                        src="{{ $program->gambar
                            ? asset('storage/'.$program->gambar)
                            : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800'
                        }}"
                        alt="{{ $program->nama }}"
                        class="program-image"
                    >

                    <span class="kategori-badge">

                        {{ $program->kategori }}

                    </span>

                </div>

                <div class="program-content">

                    <h3>

                        {{ $program->nama }}

                    </h3>

                    <p class="program-desc">

                        {{ \Illuminate\Support\Str::limit($program->deskripsi, 100) }}

                    </p>

                    <div class="progress-info">

                        <span>

                            Terkumpul: Rp {{ number_format($program->terkumpul,0,',','.') }}

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

                    <div class="target-row">

                        Target: Rp {{ number_format($program->target,0,',','.') }}

                    </div>

                    <a href="{{ route('donasi.create', $program->id) }}"
                    class="detail-btn">

                        Donasi

                    </a>

                </div>

            </div>

        @empty

            <p style="margin:20px;">Program donasi belum tersedia.</p>

        @endforelse

    </div>

</section>

<!-- DASHBOARD PUBLIK -->
<section class="dashboard-section">

    <div class="dashboard-text">

        <span class="section-label">Dashboard Publik</span>

        <h2>
            Dampak Terukur dalam Angka
        </h2>

        <p>

            Kami menyajikan data real-time aliran dana. Setiap rupiah yang
            Anda sumbangkan dapat dilacak peruntukannya. Tidak ada biaya
            tersembunyi, hanya transparansi mutlak untuk membangun
            kepercayaan jangka panjang.

        </p>

        <div class="dashboard-stats">

            <div class="dashboard-stat">

                <strong>Rp {{ number_format($totalDonasi,0,',','.') }}</strong>

                <span>Total Dana Tersalurkan</span>

            </div>

            <div class="dashboard-stat">

                <strong>{{ $totalProgram }}</strong>

                <span>Total Program</span>

            </div>

            <div class="dashboard-stat">

                <strong>{{ $programAktif }}</strong>

                <span>Program Aktif</span>

            </div>

            <div class="dashboard-stat">

                <strong>{{ $totalDonatur }}</strong>

                <span>Donatur Aktif</span>

            </div>

        </div>

        <a href="#" class="lihat-laporan">
            Akses Laporan Keuangan Lengkap ↗
        </a>

    </div>

    <div class="dashboard-card">

        <div class="dashboard-card-header">

            <h3>Distribusi Dana Bulan Ini</h3>

            <span>📊</span>

        </div>

        @php
            $distribusi = [
                ['label' => 'Pendidikan & Beasiswa', 'persen' => 45],
                ['label' => 'Kesehatan Masyarakat', 'persen' => 30],
                ['label' => 'Pemberdayaan Ekonomi', 'persen' => 15],
                ['label' => 'Operasional', 'persen' => 10],
            ];
        @endphp

        @foreach($distribusi as $d)

            <div class="distribusi-item">

                <div class="distribusi-label">

                    <span>{{ $d['label'] }}</span>
                    <span>{{ $d['persen'] }}%</span>

                </div>

                <div class="distribusi-bar">

                    <div
                        class="distribusi-fill"
                        style="width: {{ $d['persen'] }}%;"
                    ></div>

                </div>

            </div>

        @endforeach

    </div>

</section>

<!-- KONTAK -->
<section id="kontak" class="contact-section">

    <div class="contact-card">

        <h2>Punya Pertanyaan?</h2>

        <p>
            Tim support kami siap membantu Anda memahami
            lebih lanjut tentang pelaporan dan program donasi.
        </p>

        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif

        <form action="{{ route('kontak.kirim') }}"
              method="POST">

            @csrf

            <div class="contact-row">

                <div class="contact-group">

                    <label>Nama Lengkap</label>

                    <input type="text"
                           name="nama"
                           placeholder="Masukkan nama"
                           required>

                </div>

                <div class="contact-group">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           placeholder="nama@gmail.com"
                           required>

                </div>

            </div>

            <div class="contact-group">

                <label>Pesan</label>

                <textarea
                    name="pesan"
                    rows="5"
                    placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."
                    required
                ></textarea>

            </div>

            <button type="submit"
                    class="contact-btn">

                Kirim Pesan

            </button>

        </form>

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

<style>

.hero-modern{

    display:grid;
    grid-template-columns:1fr 1fr;

    align-items:center;

    gap:60px;

    padding:70px 10%;

}

.hero-kicker{

    font-size:22px;

    font-weight:600;

    line-height:1.4;

    color:#1e293b;

    margin-bottom:20px;

}

.hero-desc{

    color:#64748b;

    font-size:16px;

    line-height:1.8;

    max-width:520px;

    margin-bottom:35px;

}

.hero-actions{

    margin-bottom:0;

}

.btn-donasi{

    display:inline-block;

    background:#be163d;

    color:white;

    padding:16px 28px;

    border-radius:14px;

    text-decoration:none;

    font-weight:600;

    transition:.3s;

}

.btn-donasi:hover{

    transform:translateY(-3px);

    box-shadow:0 10px 20px rgba(190,22,61,.2);

}

.hero-image{

    display:flex;

    justify-content:center;

}

.hero-image-wrapper{

    width:100%;

    max-width:480px;

    background:linear-gradient(160deg,#7a1230 0%,#3d0a18 100%);

    padding:24px;

    border-radius:36px;

    box-shadow:0 25px 50px rgba(122,18,48,.25);

}

.hero-image img{

    width:100%;

    border-radius:24px;

    display:block;

    box-shadow:0 10px 25px rgba(0,0,0,.25);

}

@media(max-width:992px){

    .hero-modern{

        grid-template-columns:1fr;

        text-align:center;

    }

    .hero-desc{

        margin-left:auto;
        margin-right:auto;

    }

    .hero-actions{

        justify-content:center;

        display:flex;

    }

}

/* SECTION LABEL */

.section-label{

    display:inline-block;

    text-transform:uppercase;

    letter-spacing:1.5px;

    font-size:13px;

    font-weight:700;

    color:#be163d;

    margin-bottom:14px;

}

/* TENTANG */

.tentang-section{
    padding:80px 10%;
    text-align:center;
}

.tentang-content{
    max-width:800px;
    margin:0 auto 60px;
}

.tentang-content h2{
    font-size:36px;
    margin-bottom:20px;
    color:#1e293b;
}

.tentang-content p{
    color:#64748b;
    line-height:1.9;
    font-size:16px;
}

.tentang-grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));

    gap:25px;

    max-width:1100px;

    margin:0 auto;

}

.tentang-card{

    background:#f8fafc;

    border-radius:24px;

    padding:40px 30px;

    transition:.3s;

}

.tentang-card:hover{

    transform:translateY(-6px);

    box-shadow:0 15px 30px rgba(0,0,0,.06);

}

.tentang-icon{

    width:64px;
    height:64px;

    display:flex;
    align-items:center;
    justify-content:center;

    margin:0 auto 20px;

    background:#fff1f3;

    border-radius:50%;

    font-size:28px;

}

.tentang-card h3{

    color:#1e293b;
    margin-bottom:12px;
    font-size:19px;

}

.tentang-card p{

    color:#64748b;
    font-size:14px;
    line-height:1.7;

}

/* PROGRAM */

.program-section{
    padding:80px 10%;
}

.section-header{

    display:flex;

    justify-content:space-between;

    align-items:end;

    margin-bottom:50px;

}

.lihat-semua{

    color:#be163d;

    text-decoration:none;

    font-weight:700;

}

@media(max-width:768px){

    .section-header{

        flex-direction:column;

        align-items:flex-start;

        gap:20px;

    }

}

.program-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fit, minmax(300px,1fr));

    gap:30px;

}

.program-card{
    background:white;

    border-radius:28px;

    overflow:hidden;

    box-shadow:
        0 15px 30px rgba(0,0,0,.06);

    transition:.3s;
}

.program-card:hover{
    transform:translateY(-8px);

    box-shadow:
        0 25px 40px rgba(0,0,0,.1);
}

.program-image-wrap{

    position:relative;

}

.program-image{
    width:100%;

    height:220px;

    object-fit:cover;

    display:block;

    transition:.4s;
}

.program-card:hover .program-image{

    transform:scale(1.05);

}

.kategori-badge{

    position:absolute;

    top:16px;
    right:16px;

    background:rgba(255,255,255,.95);

    color:#be163d;

    padding:6px 14px;

    border-radius:50px;

    font-size:13px;

    font-weight:600;

    box-shadow:0 4px 10px rgba(0,0,0,.12);

}

.program-content{
    padding:25px;
}

.program-content h3{
    margin-bottom:10px;
    color:#1e293b;
    font-size:19px;
}

.program-desc{

    color:#64748b;

    font-size:14px;

    line-height:1.6;

    margin-bottom:18px;

}

.progress-info{
    display:flex;
    justify-content:space-between;
    font-weight:600;
    margin-bottom:10px;
    font-size:14px;
    color:#1e293b;
}

.progress-info span:last-child{

    color:#be163d;

}

.progress-bar{
    height:8px;
    background:#eee;
    border-radius:50px;
    overflow:hidden;
    margin-bottom:10px;
}

.progress-fill{
    height:100%;
    background:#be163d;
    border-radius:50px;
}

.target-row{

    text-align:right;

    color:#94a3b8;

    font-size:13px;

    margin-bottom:20px;

}

.detail-btn{

    display:block;

    width:100%;

    text-align:center;

    background:white;

    color:#be163d;

    border:2px solid #be163d;

    padding:13px;

    border-radius:14px;

    font-weight:600;

    cursor:pointer;

    transition:.3s;

}

.detail-btn:hover{

    background:#fff1f3;

}

/* DASHBOARD PUBLIK */

.dashboard-section{

    display:grid;

    grid-template-columns:1.2fr 1fr;

    gap:50px;

    padding:80px 10%;

    align-items:start;

}

.dashboard-text h2{

    font-size:36px;

    color:#1e293b;

    margin-bottom:18px;

}

.dashboard-text > p{

    color:#64748b;

    line-height:1.8;

    margin-bottom:35px;

    max-width:520px;

}

.dashboard-stats{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:25px 35px;

    margin-bottom:30px;

}

.dashboard-stat{

    border-left:3px solid #be163d;

    padding-left:16px;

}

.dashboard-stat strong{

    display:block;

    font-size:26px;

    color:#1e293b;

    margin-bottom:4px;

}

.dashboard-stat span{

    color:#64748b;

    font-size:14px;

}

.lihat-laporan{

    color:#be163d;

    font-weight:700;

    text-decoration:none;

}

.dashboard-card{

    background:white;

    border-radius:24px;

    padding:35px;

    box-shadow:0 15px 35px rgba(0,0,0,.07);

}

.dashboard-card-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

}

.dashboard-card-header h3{

    font-size:17px;

    color:#1e293b;

}

.distribusi-item{

    margin-bottom:22px;

}

.distribusi-item:last-child{

    margin-bottom:0;

}

.distribusi-label{

    display:flex;

    justify-content:space-between;

    font-size:14px;

    color:#1e293b;

    font-weight:600;

    margin-bottom:8px;

}

.distribusi-bar{

    height:8px;

    background:#f1f1f4;

    border-radius:50px;

    overflow:hidden;

}

.distribusi-fill{

    height:100%;

    background:#be163d;

    border-radius:50px;

}

@media(max-width:900px){

    .dashboard-section{

        grid-template-columns:1fr;

    }

}

/* KONTAK */

.contact-section{
    padding:100px 10%;

    display:flex;
    justify-content:center;
}

.contact-card{
    width:100%;
    max-width:800px;

    background:white;

    border-radius:30px;

    padding:60px;

    box-shadow:
        0 10px 40px rgba(0,0,0,.06);

    text-align:center;
}

.contact-card h2{
    font-size:36px;
    color:#1f2937;

    margin-bottom:15px;
}

.contact-card p{
    color:#6b7280;

    margin-bottom:40px;

    line-height:1.8;
}

.contact-row{
    display:grid;

    grid-template-columns:1fr 1fr;

    gap:20px;

    margin-bottom:20px;
}

.contact-group{
    text-align:left;

    margin-bottom:20px;
}

.contact-group label{
    display:block;

    margin-bottom:10px;

    font-weight:600;

    color:#374151;
}

.contact-group input,
.contact-group textarea{
    width:100%;

    padding:15px 18px;

    border:1px solid #d1d5db;

    border-radius:12px;

    outline:none;

    font-size:15px;

    transition:.3s;
}

.contact-group input:focus,
.contact-group textarea:focus{
    border-color:#be163d;

    box-shadow:
        0 0 0 3px rgba(190,22,61,.15);
}

.contact-btn{
    width:100%;

    background:#be163d;

    color:white;

    border:none;

    padding:16px;

    border-radius:12px;

    font-size:16px;

    font-weight:600;

    cursor:pointer;

    transition:.3s;
}

.contact-btn:hover{
    background:#9c0c2e;
}

.success-message{
    background:#fde8ec;

    color:#be163d;

    padding:15px;

    border-radius:12px;

    margin-bottom:25px;
}

@media(max-width:768px){

    .contact-card{
        padding:40px 25px;
    }

    .contact-row{
        grid-template-columns:1fr;
    }

    .contact-card h2{
        font-size:28px;
    }

}

/* MODAL DETAIL PROGRAM */

.modal{

    display:none;

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,.6);

    z-index:9999;

    justify-content:center;
    align-items:center;

    padding:20px;
}

.modal-content{

    background:white;

    width:100%;
    max-width:700px;

    border-radius:30px;

    padding:35px;

    position:relative;

    animation:modalFade .3s ease;
}

@keyframes modalFade{

    from{

        opacity:0;
        transform:translateY(20px);
    }

    to{

        opacity:1;
        transform:translateY(0);
    }
}

.close-modal{

    position:absolute;

    top:20px;
    right:25px;

    font-size:32px;

    cursor:pointer;
}

.modal-image{

    width:100%;

    height:250px;

    object-fit:cover;

    border-radius:20px;

    margin-bottom:20px;
}

.modal-content h2{

    margin:15px 0;
}

.modal-content p{

    color:#64748b;

    line-height:1.8;
}

.modal-info{

    margin:25px 0;
}

.modal-btn{

    display:block;

    text-align:center;

    background:#be163d;

    color:white;

    padding:16px;

    border-radius:14px;

    text-decoration:none;

    font-weight:600;

    transition:.3s;
}

.modal-btn:hover{

    background:#a11235;
}

@media(max-width:768px){

    .modal-content{

        padding:25px;
    }

    .modal-image{

        height:200px;
    }
}

</style>

@endsection

@extends('layouts.app')

@section('content')

<section class="donasi-page">

    {{-- HERO / PROGRAM SECTION --}}
    <div class="donasi-left">

        <div class="prog-img">
            <span class="active-badge">
                <span class="dot"></span> Donasi Aktif
            </span>
            <img
                src="{{ $program->gambar
                    ? asset('storage/' . $program->gambar)
                    : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800' }}"
                alt="{{ $program->nama }}"
            >
        </div>

        <h1 class="prog-title">{{ $program->nama }}</h1>

        <div class="prog-stats">
            <div>
                <span class="stat-label">Terkumpul</span>
                <b class="stat-value">Rp {{ number_format($program->terkumpul ?? 0, 0, ',', '.') }}</b>
            </div>
            <div style="text-align:right">
                <span class="stat-label">Target</span>
                <b class="stat-value">Rp {{ number_format($program->target, 0, ',', '.') }}</b>
            </div>
        </div>

        @php
            $persen = $program->target > 0
                ? min(100, round(($program->terkumpul ?? 0) / $program->target * 100))
                : 0;
        @endphp

        <div class="prog-bar-bg">
            <div class="prog-bar" style="width:{{ $persen }}%"></div>
        </div>

        <div class="prog-meta">
            <b>{{ $persen }}% Persen</b>
            <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                {{ $program->jumlah_donatur ?? 0 }} Donatur
            </span>
        </div>

    </div>

    {{-- FORM DONASI --}}
    <div class="donasi-right">
        <div class="form-card">

            <h2 class="form-title">Berikan Donasi Mu</h2>
            <p class="form-sub">Kontribusi Anda dilindungi oleh Jaminan Transparansi kami.</p>

            <form
                action="{{ route('donasi.store', $program->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                {{-- NOMINAL CEPAT --}}
                <div class="section-label">
                    <span>Pilih Jumlah</span>
                    <span class="label-idr">IDR</span>
                </div>

                <div class="nominal-grid">
                    <button type="button" class="nom-btn" onclick="isiNominal(this, 50000)">50k</button>
                    <button type="button" class="nom-btn active" onclick="isiNominal(this, 100000)">100k</button>
                    <button type="button" class="nom-btn" onclick="isiNominal(this, 250000)">250k</button>
                    <button type="button" class="nom-btn" onclick="isiNominal(this, 500000)">500k</button>
                    <button type="button" class="nom-btn" onclick="isiNominal(this, 1000000)">1M</button>
                    <button type="button" class="nom-btn" onclick="isiCustom(this)">Custom</button>
                </div>

                <div class="inp-prefix">
                    <span class="inp-pre">Rp</span>
                    <input
                        type="number"
                        name="nominal"
                        id="nominalInput"
                        min="10000"
                        placeholder="10.000"
                        value="{{ old('nominal', 100000) }}"
                        required
                    >
                </div>

                {{-- NAMA --}}
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input
                        class="inp"
                        type="text"
                        name="nama"
                        placeholder="John Doe"
                        value="{{ old('nama') }}"
                        required
                    >
                </div>

                {{-- EMAIL --}}
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input
                        class="inp"
                        type="email"
                        name="email"
                        placeholder="john@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <hr class="divider">

                {{-- METODE: QRIS ONLY --}}
                <div class="section-label" style="margin-bottom:12px">
                    <span>Metode Penbayaran</span>
                </div>

                <input type="hidden" name="metode" value="QRIS">

                <div class="qris-section">

                    <div class="qris-header">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><rect x="18" y="14" width="3" height="3"/><rect x="14" y="18" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/></svg>
                        QRIS – Scan &amp; Pay (All e-wallets &amp; banks)
                    </div>

                    <div class="qris-box">
                        <div class="qr-placeholder">
                            <img
                                src="{{ asset('images/qris-pedulikita.png') }}"
                                alt="QRIS PeduliKita"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                            >
                            <div class="qr-fallback" style="display:none">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="5" y="5" width="3" height="3" fill="#dc2626" stroke="none"/><rect x="16" y="5" width="3" height="3" fill="#dc2626" stroke="none"/><rect x="5" y="16" width="3" height="3" fill="#dc2626" stroke="none"/><line x1="14" y1="14" x2="14" y2="14"/><line x1="17" y1="14" x2="20" y2="14"/><line x1="14" y1="17" x2="14" y2="20"/><line x1="17" y1="17" x2="20" y2="20"/></svg>
                            </div>
                        </div>
                        <div class="qris-name">PeduliKita Foundation</div>
                        <div class="qris-label">Scan QR code di atas menggunakan aplikasi e-wallet atau mobile banking Anda</div>
                    </div>

                    {{-- UPLOAD BUKTI --}}
                    <label class="form-label" style="margin-bottom:8px">
                        Upload Bukti Pembayaran
                        <span class="required-mark">*wajib</span>
                    </label>

                    <div
                        class="upload-zone"
                        id="uploadZone"
                        onclick="document.getElementById('buktiFile').click()"
                    >
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p>Klik untuk upload bukti transfer</p>
                        <small>JPG, PNG, atau PDF · maks. 5 MB</small>
                        <input
                            type="file"
                            name="bukti_pembayaran"
                            id="buktiFile"
                            accept="image/*,.pdf"
                            onchange="handleFile(this)"
                        >
                    </div>

                    <div class="upload-preview" id="uploadPreview">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><polyline points="9 15 12 18 15 15"/><line x1="12" y1="11" x2="12" y2="18"/></svg>
                        <span class="fname" id="fileName">bukti.jpg</span>
                        <span class="remove-btn" onclick="removeFile()" title="Hapus">&times;</span>
                    </div>

                    @error('bukti_pembayaran')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror

                </div>

                {{-- PESAN --}}
                <div class="form-group">
                    <label class="form-label">Pesan (Opsional)</label>
                    <textarea
                        name="pesan"
                        class="pesan-input"
                        placeholder="Tulis pesan atau doa untuk program ini..."
                        rows="3"
                    >{{ old('pesan') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Donasi
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>

                <div class="secure-note">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Secure 256-bit SSL Encryption
                </div>

            </form>

        </div>
    </div>

</section>

<style>

/* ── Layout ─────────────────────────────────── */
.donasi-page {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 28px;
    padding: 24px 5% 60px;
    max-width: 1100px;
    margin: 0 auto;
}

/* ── Left: Program Info ──────────────────────── */
.donasi-left { padding-top: 4px; }

.prog-img {
    position: relative;
    width: 100%;
    height: 280px;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 20px;
}

.prog-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.active-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(255,255,255,0.92);
    color: #b91c1c;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
    z-index: 1;
}

.dot {
    width: 7px;
    height: 7px;
    background: #dc2626;
    border-radius: 50%;
    display: inline-block;
}

.prog-title {
    font-size: 26px;
    font-weight: 700;
    line-height: 1.3;
    color: #111;
    margin-bottom: 16px;
}

.prog-stats {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
}

.stat-label { display: block; margin-bottom: 2px; }
.stat-value { font-size: 18px; font-weight: 700; color: #111; display: block; }

.prog-bar-bg {
    height: 8px;
    background: #e0e0e0;
    border-radius: 4px;
    margin-bottom: 10px;
}

.prog-bar {
    height: 8px;
    background: #dc2626;
    border-radius: 4px;
}

.prog-meta {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #666;
}

.prog-meta b { color: #b91c1c; }

/* ── Right: Form Card ────────────────────────── */
.form-card {
    background: white;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    padding: 28px 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
}

.form-title {
    font-size: 20px;
    font-weight: 700;
    text-align: center;
    color: #111;
    margin-bottom: 4px;
}

.form-sub {
    font-size: 13px;
    color: #888;
    text-align: center;
    margin-bottom: 22px;
}

.section-label {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 600;
    color: #555;
    letter-spacing: .04em;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.label-idr { color: #b91c1c; }

/* Nominal buttons */
.nominal-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 14px;
}

.nom-btn {
    padding: 10px 4px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: white;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    text-align: center;
    transition: .15s;
}

.nom-btn:hover:not(.active) {
    background: #fef2f2;
    border-color: #dc2626;
    color: #b91c1c;
}

.nom-btn.active {
    background: #b91c1c;
    color: white;
    border-color: #b91c1c;
}

/* Rp prefix input */
.inp-prefix {
    display: flex;
    align-items: center;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 18px;
}

.inp-pre {
    padding: 12px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
    background: #f9fafb;
    border-right: 1px solid #d1d5db;
}

.inp-prefix input {
    border: none;
    outline: none;
    padding: 12px 14px;
    font-size: 15px;
    font-weight: 600;
    flex: 1;
    background: white;
    color: #111;
}

/* Form groups */
.form-group { margin-bottom: 16px; }

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 7px;
}

.inp {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 14px;
    color: #111;
    background: white;
    outline: none;
    transition: border-color .15s;
}

.inp:focus { border-color: #dc2626; }

.divider {
    border: none;
    border-top: 1px solid #f0f0f0;
    margin: 20px 0;
}

/* QRIS section */
.qris-section {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 18px;
}

.qris-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #991b1b;
    margin-bottom: 14px;
}

.qris-box {
    background: white;
    border-radius: 10px;
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    border: 1px solid #fecaca;
}

.qr-placeholder {
    width: 130px;
    height: 130px;
    border-radius: 8px;
    overflow: hidden;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qr-placeholder img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.qr-fallback {
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
}

.qris-name {
    font-size: 14px;
    font-weight: 700;
    color: #991b1b;
    text-align: center;
}

.qris-label {
    font-size: 12px;
    color: #666;
    text-align: center;
    line-height: 1.5;
}

.required-mark {
    color: #e24b4a;
    font-size: 11px;
    font-weight: 400;
    margin-left: 4px;
}

/* Upload zona */
.upload-zone {
    border: 2px dashed #fecaca;
    border-radius: 10px;
    padding: 22px 16px;
    text-align: center;
    cursor: pointer;
    background: white;
    transition: background .15s;
}

.upload-zone:hover { background: #fef2f2; }

.upload-zone svg { margin-bottom: 8px; display: block; margin-left: auto; margin-right: auto; }

.upload-zone p {
    font-size: 13px;
    color: #555;
    margin-bottom: 4px;
    font-weight: 500;
}

.upload-zone small { font-size: 11px; color: #aaa; }

.upload-zone input { display: none; }

.upload-preview {
    display: none;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    background: #fef2f2;
    border-radius: 8px;
    font-size: 13px;
    border: 1px solid #fecaca;
}

.upload-preview .fname {
    color: #991b1b;
    font-weight: 600;
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.remove-btn {
    color: #888;
    cursor: pointer;
    font-size: 20px;
    line-height: 1;
    font-weight: 300;
}

.remove-btn:hover { color: #e24b4a; }

.err-msg {
    font-size: 12px;
    color: #e24b4a;
    margin-top: 5px;
}

/* Pesan */
.pesan-input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 13px;
    color: #111;
    background: white;
    outline: none;
    resize: vertical;
    min-height: 80px;
    font-family: inherit;
    transition: border-color .15s;
}

.pesan-input:focus { border-color: #dc2626; }

/* Submit button */
.btn-submit {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 10px;
    background: #b91c1c;
    color: white;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 6px;
    transition: background .15s;
}

.btn-submit:hover { background: #991b1b; }

.secure-note {
    text-align: center;
    font-size: 12px;
    color: #aaa;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

/* ── Responsive ──────────────────────────────── */
@media (max-width: 900px) {
    .donasi-page {
        grid-template-columns: 1fr;
        padding: 20px 4% 48px;
    }
}

@media (max-width: 480px) {
    .nominal-grid { grid-template-columns: repeat(3, 1fr); }
    .form-card { padding: 20px 16px; }
}

</style>

<script>
function isiNominal(el, nominal) {
    document.querySelectorAll('.nom-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('nominalInput').value = nominal;
}

function isiCustom(el) {
    document.querySelectorAll('.nom-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    const inp = document.getElementById('nominalInput');
    inp.value = '';
    inp.focus();
}

function handleFile(input) {
    if (!input.files || !input.files[0]) return;
    const f = input.files[0];
    document.getElementById('fileName').textContent = f.name;
    document.getElementById('uploadZone').style.display = 'none';
    document.getElementById('uploadPreview').style.display = 'flex';
}

function removeFile() {
    document.getElementById('buktiFile').value = '';
    document.getElementById('uploadZone').style.display = 'block';
    document.getElementById('uploadPreview').style.display = 'none';
}
</script>

@endsection

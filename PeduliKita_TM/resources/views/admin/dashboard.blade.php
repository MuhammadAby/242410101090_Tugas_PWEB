```blade
@extends('layouts.admin')

@section('content')

<div class="dashboard-header">

    <div>

        <h2>Dashboard Ringkasan</h2>

        <p>
            Selamat datang kembali,
            <strong>{{ auth()->user()->name }}</strong>.
        </p>

    </div>

</div>

{{-- Statistik --}}
<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon green">

            <i class="fa-solid fa-wallet"></i>

        </div>

        <div>

            <h4>Total Donasi</h4>

            <h3>
                Rp {{ number_format($totalDonasi,0,',','.') }}
            </h3>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon blue">

            <i class="fa-solid fa-gift"></i>

        </div>

        <div>

            <h4>Program Donasi</h4>

            <h3>{{ $totalProgram }}</h3>

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon orange">

            <i class="fa-solid fa-users"></i>

        </div>

        <div>

            <h4>Total Donatur</h4>

            <h3>{{ $totalDonatur }}</h3>

        </div>

    </div>

</div>

{{-- Donasi Terbaru --}}
<div class="dashboard-card">

    <div class="card-title">

        <h3>Donasi Terbaru</h3>

    </div>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>Donatur</th>

                    <th>Program</th>

                    <th>Jumlah</th>

                    <th>Tanggal</th>

                </tr>

            </thead>

            <tbody>

                @forelse($donasiTerbaru as $donasi)

                <tr>

                    <td>
                        {{ $donasi->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $donasi->programDonasi->nama ?? '-' }}
                    </td>

                    <td>

                        Rp {{ number_format($donasi->nominal,0,',','.') }}

                    </td>

                    <td>

                        {{ $donasi->created_at->format('d M Y') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="kosong">

                        Belum ada donasi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- Program Donasi --}}
<div class="dashboard-card">

    <div class="card-title">

        <h3>Program Donasi</h3>

    </div>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>Nama Program</th>

                    <th>Target</th>

                    <th>Terkumpul</th>

                    <th>Progress</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($programs as $program)

                @php

                    $persen = $program->target > 0
                        ? ($program->terkumpul / $program->target) * 100
                        : 0;

                @endphp

                <tr>

                    <td>

                        {{ $program->nama }}

                    </td>

                    <td>

                        Rp {{ number_format($program->target,0,',','.') }}

                    </td>

                    <td>

                        Rp {{ number_format($program->terkumpul,0,',','.') }}

                    </td>

                    <td>

                        <div class="progress-container">

                            <div class="progress-bar">

                                <div class="progress-fill"
                                     style="width: {{ min($persen,100) }}%">

                                </div>

                            </div>

                            <span>

                                {{ number_format($persen,0) }}%

                            </span>

                        </div>

                    </td>

                    <td>

                        @if($program->terkumpul >= $program->target)

                            <span class="badge selesai">

                                Selesai

                            </span>

                        @else

                            <span class="badge aktif">

                                Aktif

                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="kosong">

                        Belum ada program donasi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<style>

.dashboard-header{

    margin-bottom:30px;

}

.dashboard-header h2{

    font-size:28px;

    margin-bottom:8px;

}

.dashboard-header p{

    color:#64748b;

}

.stats-grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:30px;

}

.stat-card{

    background:white;

    border-radius:18px;

    padding:20px;

    display:flex;

    gap:15px;

    align-items:center;

    box-shadow:0 3px 15px rgba(0,0,0,0.05);

}

.stat-icon{

    width:50px;

    height:50px;

    border-radius:14px;

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    font-size:20px;

}

.green{

    background:#22c55e;

}

.blue{

    background:#3b82f6;

}

.orange{

    background:#f59e0b;

}

.stat-card h4{

    color:#64748b;

    font-size:14px;

    margin-bottom:5px;

}

.stat-card h3{

    font-size:24px;

}

.dashboard-card{

    background:white;

    border-radius:18px;

    padding:25px;

    margin-bottom:25px;

    box-shadow:0 3px 15px rgba(0,0,0,0.05);

}

.card-title{

    margin-bottom:20px;

}

.card-title h3{

    font-size:20px;

}

.table-wrapper{

    overflow-x:auto;

}

table{

    width:100%;

    border-collapse:collapse;

}

th{

    background:#f8fafc;

    color:#64748b;

    font-weight:600;

    padding:15px;

    text-align:left;

}

td{

    padding:15px;

    border-bottom:1px solid #e2e8f0;

}

tbody tr:hover{

    background:#f8fafc;

}

.progress-container{

    display:flex;

    align-items:center;

    gap:10px;

}

.progress-bar{

    width:120px;

    height:8px;

    background:#e2e8f0;

    border-radius:20px;

    overflow:hidden;

}

.progress-fill{

    height:100%;

    background:#22c55e;

}

.badge{

    padding:6px 12px;

    border-radius:20px;

    font-size:13px;

    font-weight:600;

}

.aktif{

    background:#dcfce7;

    color:#15803d;

}

.selesai{

    background:#dbeafe;

    color:#2563eb;

}

.kosong{

    text-align:center;

    color:#64748b;

}

</style>

@endsection
```

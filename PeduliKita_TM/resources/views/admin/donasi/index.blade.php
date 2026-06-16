@extends('layouts.admin')

@section('content')

<h1 style="margin-bottom:25px;">
    Riwayat Donasi
</h1>

<div style="
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    <table style="
        width:100%;
        border-collapse:collapse;
    ">

        <thead>

            <tr style="
                background:#be163d;
                color:white;
            ">

                <th style="padding:15px;">No</th>

                <th style="padding:15px;">
                    Donatur
                </th>

                <th style="padding:15px;">
                    Program
                </th>

                <th style="padding:15px;">
                    Jumlah
                </th>

                <th style="padding:15px;">
                    Status
                </th>

                <th style="padding:15px;">
                    Tanggal
                </th>

                <th style="padding:15px;">
                    Aksi
                </th>

                <th style="padding:15px;">
                    Bukti Transfer
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($donasis as $donasi)

            <tr style="
                border-bottom:1px solid #eee;
            ">

                <td style="padding:15px;">
                    {{ $loop->iteration }}
                </td>

                <td style="padding:15px;">
                    {{ $donasi->nama }}
                </td>

                <td style="padding:15px;">
                    {{ optional($donasi->programDonasi)->nama ?? '-' }}
                </td>

                <td style="padding:15px;">
                    Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                </td>

                <td style="padding:15px;">

                    @if($donasi->status == 'pending')

                        <span style="
                            background:#fff3cd;
                            color:#856404;
                            padding:5px 10px;
                            border-radius:10px;
                        ">
                            Menunggu
                        </span>

                    @elseif($donasi->status == 'terverifikasi')

                        <span style="
                            background:#d4edda;
                            color:#155724;
                            padding:5px 10px;
                            border-radius:10px;
                        ">
                            Terverifikasi
                        </span>

                    @else

                        <span style="
                            background:#f8d7da;
                            color:#721c24;
                            padding:5px 10px;
                            border-radius:10px;
                        ">
                            Ditolak
                        </span>

                    @endif

                </td>

                <td style="padding:15px;">
                    {{ $donasi->created_at->format('d M Y') }}
                </td>

                <td style="padding:15px;">

                        @if($donasi->status == 'pending')

                            <form
                                action="{{ route('admin.donasi.verifikasi', $donasi->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="terverifikasi"
                                >

                                <button
                                    type="submit"
                                    style="
                                        background:#28a745;
                                        color:white;
                                        border:none;
                                        padding:8px 12px;
                                        border-radius:8px;
                                        cursor:pointer;
                                    "
                                >
                                    Verifikasi
                                </button>

                            </form>

                            <form
                                action="{{ route('admin.donasi.verifikasi', $donasi->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="ditolak"
                                >

                                <button
                                    type="submit"
                                    style="
                                        background:#dc3545;
                                        color:white;
                                        border:none;
                                        padding:8px 12px;
                                        border-radius:8px;
                                        cursor:pointer;
                                    "
                                >
                                    Tolak
                                </button>

                            </form>

                        @else

                            -

                        @endif

                    </td>

                    <td style="padding:15px;">

                        @if($donasi->bukti_transfer)

                            <a href="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                            target="_blank"
                            style="
                                    /* background:#be163d; */
                                    color:rgb(13, 13, 13);
                                    padding:8px 14px;
                                    border-radius:8px;
                                    text-decoration:none;
                            ">
                                Lihat
                            </a>

                        @else

                            <span style="color:#999;">
                                Tidak Ada
                            </span>

                        @endif

                    </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    style="
                        text-align:center;
                        padding:30px;
                    ">

                    Belum ada data donasi.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection

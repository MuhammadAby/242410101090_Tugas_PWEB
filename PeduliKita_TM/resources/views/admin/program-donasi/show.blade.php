@extends('layouts.admin')

@section('content')

<h1>Detail Program Donasi</h1>

<div class="card">

    @if($programDonasi->gambar)
        <img src="{{ asset('storage/'.$programDonasi->gambar) }}"
             width="300">
    @endif

    <p><strong>Nama :</strong>
        {{ $programDonasi->nama }}
    </p>

    <p><strong>Kategori :</strong>
        {{ $programDonasi->kategori }}
    </p>

    <p><strong>Target :</strong>
        Rp {{ number_format($programDonasi->target,0,',','.') }}
    </p>

    <p><strong>Terkumpul :</strong>
        Rp {{ number_format($programDonasi->terkumpul,0,',','.') }}
    </p>

    <p><strong>Tanggal Mulai :</strong>
        {{ $programDonasi->tanggal_mulai }}
    </p>

    <a href="{{ route('admin.program-donasi.index') }}">
        Kembali
    </a>

</div>

@endsection

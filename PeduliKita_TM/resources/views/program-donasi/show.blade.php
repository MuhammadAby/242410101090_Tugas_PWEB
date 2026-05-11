@extends('layouts.app')

@section('content')

<h1>Detail Program Donasi</h1>

<p>
    <strong>Nama:</strong>
    {{ $programDonasi->nama }}
</p>

<p>
    <strong>Kategori:</strong>
    {{ $programDonasi->kategori }}
</p>

<p>
    <strong>Target:</strong>
    Rp {{ number_format($programDonasi->target) }}
</p>

<p>
    <strong>Terkumpul:</strong>
    Rp {{ number_format($programDonasi->terkumpul) }}
</p>

@endsection

@extends('layouts.app')

@section('content')

<section style="padding:80px 10%;">

    <h1>{{ $program->nama }}</h1>

    <p>
        Kategori:
        {{ $program->kategori }}
    </p>

    <p>
        {{ $program->deskripsi }}
    </p>

    <p>
        Target:
        Rp {{ number_format($program->target,0,',','.') }}
    </p>

    <p>
        Terkumpul:
        Rp {{ number_format($program->terkumpul,0,',','.') }}
    </p>

    <a
        href="{{ route('donasi.create', $program->id) }}"
        style="
            background:#be163d;
            color:white;
            padding:15px 25px;
            text-decoration:none;
            border-radius:12px;
        "
    >
        Donasi Sekarang
    </a>

</section>

@endsection

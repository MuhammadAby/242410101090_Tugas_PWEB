@extends('layouts.app')

@section('content')

<h1>Edit Program Donasi</h1>

<form action="{{ route('program-donasi.update', $programDonasi->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div>

        <label>Nama Program</label>

        <input
            type="text"
            name="nama"
            value="{{ old('nama', $programDonasi->nama) }}"
        >

        @error('nama')
            <small>{{ $message }}</small>
        @enderror

    </div>

    <div>

        <label>Kategori</label>

        <select name="kategori">

            <option
                {{ $programDonasi->kategori == 'Bencana Alam' ? 'selected' : '' }}>
                Bencana Alam
            </option>

            <option
                {{ $programDonasi->kategori == 'Anak Yatim' ? 'selected' : '' }}>
                Anak Yatim
            </option>

            <option
                {{ $programDonasi->kategori == 'Pendidikan' ? 'selected' : '' }}>
                Pendidikan
            </option>

            <option
                {{ $programDonasi->kategori == 'Masjid' ? 'selected' : '' }}>
                Masjid
            </option>

            <option
                {{ $programDonasi->kategori == 'Kesehatan' ? 'selected' : '' }}>
                Kesehatan
            </option>

        </select>

    </div>

    <div>

        <label>Target Dana</label>

        <input
            type="number"
            name="target"
            value="{{ old('target', $programDonasi->target) }}"
        >

        @error('target')
            <small>{{ $message }}</small>
        @enderror

    </div>

    <button type="submit">
        Update
    </button>

</form>

@endsection

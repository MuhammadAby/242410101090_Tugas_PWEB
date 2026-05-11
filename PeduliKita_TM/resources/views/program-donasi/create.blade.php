@extends('layouts.app')

@section('content')

<h1>Tambah Program Donasi</h1>

<form action="{{ route('program-donasi.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div>
        <label>Nama Program</label>

        <input type="text"
               name="nama"
               value="{{ old('nama') }}">

        @error('nama')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label>Kategori</label>

        <select name="kategori">

            <option value="">-- Pilih Kategori --</option>

            <option>Bencana Alam</option>
            <option>Anak Yatim</option>
            <option>Pendidikan</option>
            <option>Masjid</option>
            <option>Kesehatan</option>

        </select>

        @error('kategori')
            <small>{{ $message }}</small>
        @enderror

    </div>

    <div>
        <label>Target Dana</label>

        <input type="number"
               name="target"
               value="{{ old('target') }}">

        @error('target')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label>Tanggal Mulai</label>

        <input type="date"
               name="tanggal_mulai"
               value="{{ old('tanggal_mulai') }}">

        @error('tanggal_mulai')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label>Foto Program</label>

        <input type="file" name="gambar">

        @error('gambar')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <button type="submit">
        Simpan
    </button>

</form>

@endsection

@extends('layouts.admin')

@section('content')

<h1>Edit Program Donasi</h1>

<form action="{{ route('admin.program-donasi.update',$programDonasi->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text"
           name="nama"
           value="{{ old('nama',$programDonasi->nama) }}">

    <label>Kategori</label>
    <input type="text"
           name="kategori"
           value="{{ old('kategori',$programDonasi->kategori) }}">

    <label>Target</label>
    <input type="number"
           name="target"
           value="{{ old('target',$programDonasi->target) }}">

    <label>Tanggal Mulai</label>
    <input type="date"
           name="tanggal_mulai"
           value="{{ old('tanggal_mulai',$programDonasi->tanggal_mulai) }}">

    <label>Gambar</label>
    <input type="file" name="gambar">

    <br><br>

    <button type="submit">
        Simpan Perubahan
    </button>

</form>

@endsection

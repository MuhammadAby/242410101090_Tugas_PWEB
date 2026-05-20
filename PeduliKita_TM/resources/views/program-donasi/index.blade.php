@extends('layouts.app')

@section('content')

<h1>Daftar Program Donasi</h1>

<a href="{{ route('program-donasi.create') }}">
    Tambah Program
</a>

<input type="text" id="search" placeholder="Cari program..." style="margin-bottom:10px;">

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Target</th>
            <th>Terkumpul</th>
            <th>Aksi</th>
            <th>Gambar</th>
        </tr>
    </thead>

    <tbody id="hasil-search">
        @forelse($programs as $program)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $program->nama }}</td>
            <td>{{ $program->kategori }}</td>
            <td>Rp {{ number_format($program->target) }}</td>
            <td>Rp {{ number_format($program->terkumpul) }}</td>
            <td>
                <a href="{{ route('program-donasi.show', $program->id) }}">Detail</a>
                <a href="{{ route('program-donasi.edit', $program->id) }}">Edit</a>

                <form action="{{ route('program-donasi.destroy', $program->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
            <td>
                @if($program->gambar)
                    <img src="{{ asset('storage/' . $program->gambar) }}" width="80">
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Data kosong</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- pagination HARUS di luar table --}}
{{ $programs->links() }}

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    console.log("JS jalan"); // debug

    const input = document.getElementById('search');

    if (!input) return;

    input.addEventListener('keyup', async function () {

        let keyword = this.value;

        let response = await fetch(`/search-program?keyword=${keyword}`);
        let html = await response.text();

        document.getElementById('hasil-search').innerHTML = html;

    });

});
</script>
@endpush

@endsection

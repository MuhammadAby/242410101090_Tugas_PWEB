@extends('layouts.app')

@section('content')

<h1>Daftar Program Donasi</h1>

<a href="{{ route('program-donasi.create') }}">
    Tambah Program
</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Target</th>
        <th>Terkumpul</th>
        <th>Aksi</th>
        <th>Gambar</th>
        {{ $programs->links() }}
    </tr>

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
                style="display:inline;"
                onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>
        </td>
        <td>
            @if($program->gambar)
                <img src="{{ asset('storage/' . $program->gambar) }}"
                    width="80">
            @endif
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="6">
            Data program donasi kosong
        </td>
    </tr>
    @endforelse

</table>

@endsection

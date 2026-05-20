@forelse($programs as $program)
<tr>
    <td>-</td>
    <td>{{ $program->nama }}</td>
    <td>{{ $program->kategori }}</td>
    <td>Rp {{ number_format($program->target) }}</td>
    <td>Rp {{ number_format($program->terkumpul) }}</td>
    <td>
        <a href="{{ route('program-donasi.show', $program->id) }}">Detail</a>
        <a href="{{ route('program-donasi.edit', $program->id) }}">Edit</a>
    </td>
    <td>
        @if($program->gambar)
            <img src="{{ asset('storage/' . $program->gambar) }}" width="80">
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="7">Tidak ada data</td>
</tr>
@endforelse

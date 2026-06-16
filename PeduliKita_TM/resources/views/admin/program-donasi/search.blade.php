@forelse($programs as $program)

@php

    $persen = $program->target > 0
        ? ($program->terkumpul / $program->target) * 100
        : 0;

@endphp

<tr>

    <td>

        <div class="program-info">

            @if($program->gambar)

                <img src="{{ asset('storage/' . $program->gambar) }}"
                     alt="gambar">

            @else

                <div class="no-image">

                    <i class="fa-solid fa-image"></i>

                </div>

            @endif

            <div>

                <strong>

                    {{ $program->nama }}

                </strong>

            </div>

        </div>

    </td>

    <td>

        {{ $program->kategori }}

    </td>

    <td>

        Rp {{ number_format($program->target,0,',','.') }}

    </td>

    <td>

        <div class="progress-wrapper">

            <div>

                <small>

                    {{ number_format($persen,0) }}%

                </small>

                <div class="progress-bar">

                    <div class="progress-fill"
                         style="width: {{ min($persen,100) }}%">

                    </div>

                </div>

            </div>

            <small>

                Rp {{ number_format($program->terkumpul,0,',','.') }}

            </small>

        </div>

    </td>

    <td>

        @if($program->terkumpul >= $program->target)

            <span class="badge selesai">

                Selesai

            </span>

        @else

            <span class="badge aktif">

                Aktif

            </span>

        @endif

    </td>

    <td>

        <div class="aksi">

            <a href="{{ route('admin.program-donasi.show', $program->id) }}"
               class="btn-detail">

                <i class="fa-solid fa-eye"></i>

            </a>

            <a href="{{ route('admin.program-donasi.edit', $program->id) }}"
               class="btn-edit">

                <i class="fa-solid fa-pen"></i>

            </a>

            <form action="{{ route('admin.program-donasi.destroy', $program->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn-hapus"
                        onclick="return confirm('Yakin ingin menghapus program ini?')">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="6"
        class="kosong">

        Program tidak ditemukan.

    </td>

</tr>

@endforelse


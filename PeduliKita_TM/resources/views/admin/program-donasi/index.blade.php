
@extends('layouts.admin')

@section('content')

<div class="page-header">

    <div>

        <h1>Manajemen Program</h1>

        <p>
            Kelola donasi, status, dan detail program transparansi.
        </p>

    </div>

    <a href="{{ route('admin.program-donasi.create') }}"
       class="btn-tambah">

        <i class="fa-solid fa-plus"></i>

        Tambah Program Baru

    </a>

</div>


{{-- Filter
<div class="filter-card">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input type="text"
               id="search"
               placeholder="Cari program...">

    </div>

    <select id="kategori">

        <option value="">Semua Kategori</option>

        <option value="Pendidikan">Pendidikan</option>

        <option value="Kesehatan">Kesehatan</option>

        <option value="Pangan">Pangan</option>

        <option value="Bencana">Bencana</option>

    </select>

    <select id="status">

        <option value="">Semua Status</option>

        <option value="aktif">Aktif</option>

        <option value="selesai">Selesai</option>

    </select>

</div> --}}

<div class="filter-card">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input type="text"
               id="search"
               placeholder="Cari program...">

    </div>

</div>

{{-- Tabel --}}
<div class="table-card">

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>Program</th>

                    <th>Kategori</th>

                    <th>Target Donasi</th>

                    <th>Progress</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody id="hasil-search">

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

                            <button type="button"
                                    class="btn-detail"
                                    onclick="lihatDetail({{ $program->id }})">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                            <button type="button"
                                    class="btn-edit"
                                    onclick="bukaEdit({{ $program->id }})">

                                <i class="fa-solid fa-pen"></i>

                            </button>

                            <form action="{{ route('admin.program-donasi.destroy', $program->id) }}"
                                  method="POST">

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

                    <td colspan="6" class="kosong">

                        Belum ada program donasi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="pagination-wrapper">

        {{ $programs->links() }}

    </div>

</div>

{{-- // DETAIL --}}

<div class="modal-overlay" id="detailModal">

    <div class="modal-content">

        <div class="modal-header">

            <div>

                <h2>Detail Program Donasi</h2>

                <p>Informasi lengkap program donasi.</p>

            </div>

            <button class="close-btn"
                    onclick="tutupDetail()">

                ×

            </button>

        </div>

        <div class="detail-body">

            <div class="detail-image-wrapper">

                <img id="detailGambar"
                    src=""
                    class="detail-image">

            </div>

            <div class="detail-item">

                <strong>Nama Program</strong>

                <p id="detailNama"></p>

            </div>

            <div class="detail-item">

                <strong>Kategori</strong>

                <p id="detailKategori"></p>

            </div>

            <div class="detail-item">

                <strong>Target Donasi</strong>

                <p id="detailTarget"></p>

            </div>

            <div class="detail-item">

                <strong>Dana Terkumpul</strong>

                <p id="detailTerkumpul"></p>

            </div>

            <div class="detail-item">

                <strong>Tanggal Mulai</strong>

                <p id="detailTanggal"></p>

            </div>

            <div class="detail-item">

                <strong>Progress</strong>

                <div class="modal-progress">

                    <div class="modal-progress-fill"
                         id="detailProgressBar">

                    </div>

                </div>

                <span id="detailPersen"></span>

            </div>

        </div>

    </div>

</div>


{{-- EDIT MODAL --}}
<div class="modal-overlay" id="editModal">

    <div class="modal-content edit-modal">

        <div class="modal-header">

            <div>

                <h2>Edit Program</h2>

                <p>Perbarui informasi program donasi.</p>

            </div>

            <button type="button"
                    class="close-btn"
                    onclick="tutupEdit()">

                ×

            </button>

        </div>

        <form id="editForm"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="hidden"
                   id="editId">

            <div class="modal-body">

                <div class="form-group">

                    <label>Nama Program</label>

                    <input type="text"
                           id="editNama"
                           class="form-control"
                           required>

                </div>

                <div class="form-group">

                    <label>Kategori</label>

                    <input type="text"
                           id="editKategori"
                           class="form-control"
                           required>

                </div>

                <div class="form-group">

                    <label>Target Donasi</label>

                    <input type="number"
                           id="editTarget"
                           class="form-control"
                           required>

                </div>

                <div class="form-group">

                    <label>Tanggal Mulai</label>

                    <input type="date"
                           id="editTanggal"
                           class="form-control"
                           required>

                </div>

                <div class="form-group">

                    <label>Gambar Saat Ini</label>

                    <img id="previewGambar"
                         src=""
                         class="preview-image"
                         alt="Preview">

                </div>

                <div class="form-group">

                    <label>Ganti Gambar</label>

                    <input type="file"
                           id="editGambar"
                           class="form-control"
                           accept="image/*">

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn-batal"
                        onclick="tutupEdit()">

                    Batal

                </button>

                <button type="submit"
                        class="btn-simpan">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>


<style>

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:30px;

}

.page-header h1{

    font-size:48px;
    margin-bottom:10px;

}

.page-header p{

    color:#64748b;

}

.btn-tambah{

    background:#22c55e;
    color:white;

    text-decoration:none;

    padding:14px 24px;

    border-radius:30px;

    font-weight:600;

}

.filter-card{

    background:white;

    padding:18px;

    border-radius:18px;

    margin-bottom:25px;

    display:flex;
    gap:15px;

    box-shadow:0 3px 15px rgba(0,0,0,.05);

}

.search-box{

    flex:1;

    display:flex;
    align-items:center;
    gap:10px;

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:0 15px;

}

.search-box input{

    border:none;

    outline:none;

    width:100%;

    padding:14px 0;

}

.filter-card select{

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:0 15px;

    min-width:180px;

}

.table-card{

    background:white;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 3px 15px rgba(0,0,0,.05);

}

table{

    width:100%;
    border-collapse:collapse;

}

th{

    background:#f8fafc;

    padding:20px;

    text-align:left;

}

td{

    padding:20px;

    border-bottom:1px solid #f1f5f9;

}

.program-info{

    display:flex;
    align-items:center;
    gap:15px;

}

.program-info img,
.no-image{

    width:50px;
    height:50px;

    border-radius:10px;

    object-fit:cover;

    background:#f1f5f9;

    display:flex;
    align-items:center;
    justify-content:center;

}

.progress-wrapper{

    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;

}

.progress-bar{

    width:180px;
    height:8px;

    background:#e2e8f0;

    border-radius:20px;

    overflow:hidden;

}

.progress-fill{

    height:100%;

    background:#22c55e;

}

.badge{

    padding:6px 14px;

    border-radius:20px;

    font-size:13px;

}

.aktif{

    background:#dcfce7;
    color:#15803d;

}

.selesai{

    background:#e2e8f0;
    color:#475569;

}

.aksi{

    display:flex;
    gap:10px;

}

.btn-detail,
.btn-edit,
.btn-hapus{

    width:40px;
    height:40px;

    border:none;

    border-radius:10px;

    text-decoration:none;

    display:flex;
    align-items:center;
    justify-content:center;

    cursor:pointer;

}

.btn-detail{

    background:#dbeafe;
    color:#2563eb;

}

.btn-edit{

    background:#fef3c7;
    color:#d97706;

}

.btn-hapus{

    background:#fee2e2;
    color:#dc2626;

}

.pagination-wrapper{

    padding:20px;

}

.kosong{

    text-align:center;

    color:#64748b;

}

/* TOMBOL DETAIL */

.modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);

    display: none;
    align-items: center;
    justify-content: center;

    padding: 20px;

    z-index: 9999;
}

.modal-content{
    width: 100%;
    max-width: 500px;

    max-height: 90vh;

    background: white;

    border-radius: 20px;

    overflow: hidden;

    display: flex;
    flex-direction: column;
}

.modal-header{
    padding: 20px 25px;

    border-bottom: 1px solid #e2e8f0;

    display: flex;
    justify-content: space-between;
    align-items: center;

    flex-shrink: 0;
}

.modal-header h2{
    margin: 0;
    font-size: 24px;
}

.modal-header p{
    margin-top: 5px;
    color: #64748b;
    font-size: 14px;
}

.close-btn{
    border: none;
    background: none;

    font-size: 32px;

    cursor: pointer;
}

.detail-body{
    padding: 25px;

    overflow-y: auto;
}

.detail-image-wrapper{

    width:100%;
    height:250px;

    background:#f8fafc;

    border-radius:15px;

    display:flex;
    align-items:center;
    justify-content:center;

    overflow:hidden;

    margin-bottom:20px;
}

/* .detail-image{

    max-width:100%;
    max-height:100%;

    object-fit:contain;
} */

.detail-image{
    width:100%;
    height:250px;

    object-fit:contain;

    border-radius:15px;

    background:#f8fafc;

    margin-bottom:20px;
}

.detail-item{
    margin-bottom: 18px;
}

.detail-item strong{
    display: block;

    margin-bottom: 6px;

    color: #475569;
}

.detail-item p{
    margin: 0;

    font-size: 15px;
}

.modal-progress{
    height: 8px;

    background: #e2e8f0;

    border-radius: 999px;

    overflow: hidden;

    margin: 10px 0;
}

.modal-progress-fill{
    height: 100%;

    background: #22c55e;

    width: 0;
}


/* EDIT */

.modal-overlay{

    position: fixed;
    inset: 0;

    background: rgba(0,0,0,.5);

    display: none;
    justify-content: center;
    align-items: center;

    z-index: 9999;
}

.edit-modal{
    background: white;
    width: 90%;
    max-width: 850px;

    position: fixed;
    top: 50%;
    left: 50%;

    transform: translate(-50%, -50%);

    max-height: 90vh;

    overflow-y: auto;

    border-radius: 24px;
}

.modal-header{

    padding: 25px 35px;

    border-bottom: 1px solid #e5e7eb;

    display: flex;
    justify-content: space-between;
    align-items: center;

    flex-shrink: 0;
}

.modal-header h2{

    margin: 0;
}

.modal-header p{

    margin-top: 8px;

    color: #64748b;
}

.close-btn{

    border: none;
    background: transparent;

    font-size: 40px;

    cursor: pointer;
}

.modal-body{

    padding: 30px 35px;

    overflow-y: auto;
}

.modal-footer{

    padding: 25px 35px;

    border-top: 1px solid #e5e7eb;

    display: flex;
    justify-content: flex-end;
    gap: 15px;

}

.form-group{

    margin-bottom: 24px;
}

.form-group label{

    display: block;

    margin-bottom: 10px;

    font-weight: 600;
}

.form-control{

    width: 100%;

    padding: 16px 18px;

    border: 1px solid #d1d5db;

    border-radius: 14px;

    font-size: 16px;
}

.preview-image{

    width: 100%;
    max-height: 250px;

    object-fit: contain;

    border-radius: 12px;

    border: 1px solid #e5e7eb;

    background: #f8fafc;
}

.btn-batal{

    border: none;

    padding: 14px 24px;

    border-radius: 14px;

    background: #e5e7eb;

    cursor: pointer;
}

.btn-simpan{

    border: none;

    padding: 14px 24px;

    border-radius: 14px;

    background: #22c55e;

    color: white;

    cursor: pointer;
}

@media(max-width:992px){

    .page-header{

        flex-direction:column;
        align-items:flex-start;
        gap:20px;

    }

    .filter-card{

        flex-direction:column;

    }

}

</style>


<script>

document.getElementById('search')
    .addEventListener('keyup', async function(){

        let keyword = this.value;

        let response = await fetch(
            `{{ route('admin.program-donasi.search') }}?keyword=${keyword}`
        );

        let html = await response.text();

        document.getElementById('hasil-search')
            .innerHTML = html;

    });

// DETAIL
async function lihatDetail(id){

    const response = await fetch(
        `/admin/program-donasi/${id}/detail`
    );

    const data = await response.json();

    document.getElementById('detailNama')
        .innerText = data.nama;

    document.getElementById('detailKategori')
        .innerText = data.kategori;

    document.getElementById('detailTarget')
        .innerText = 'Rp ' +
        Number(data.target).toLocaleString('id-ID');

    document.getElementById('detailTerkumpul')
        .innerText = 'Rp ' +
        Number(data.terkumpul).toLocaleString('id-ID');

    document.getElementById('detailTanggal')
        .innerText = data.tanggal_mulai;

    let persen = 0;

    if(data.target > 0){

        persen = (data.terkumpul / data.target) * 100;

    }

    document.getElementById('detailPersen')
        .innerText =
        persen.toFixed(0) + '%';

    document.getElementById('detailProgressBar')
        .style.width =
        Math.min(persen,100) + '%';

    if(data.gambar){

        document.getElementById('detailGambar')
            .src = '/storage/' + data.gambar;

    }

    document.getElementById('detailModal')
        .style.display = 'flex';

}

function tutupDetail(){

    document.getElementById('detailModal')
        .style.display = 'none';

}

// TOMBOL EDIT
async function bukaEdit(id){

    const response = await fetch(
        `/admin/program-donasi/${id}/edit-data`
    );

    const data = await response.json();

    document.getElementById('editId').value =
        data.id;

    document.getElementById('editNama').value =
        data.nama;

    document.getElementById('editKategori').value =
        data.kategori;

    document.getElementById('editTarget').value =
        data.target;

    document.getElementById('editTanggal').value =
        data.tanggal_mulai;

    document.getElementById('previewGambar').src =
        data.gambar
            ? `/storage/${data.gambar}`
            : '';

    document.getElementById('editModal')
        .style.display = 'flex';
}

function tutupEdit(){

    document.getElementById('editModal')
        .style.display = 'none';

    document.getElementById('editForm')
        .reset();
}

document.getElementById('editGambar')
    .addEventListener('change', function(){

        if(this.files.length > 0){

            document.getElementById('previewGambar')
                .src = URL.createObjectURL(this.files[0]);
        }
    });

document.getElementById('editForm')
    .addEventListener('submit', async function(e){

    e.preventDefault();

    const id =
        document.getElementById('editId').value;

    let formData = new FormData();

    formData.append(
        '_token',
        '{{ csrf_token() }}'
    );

    formData.append(
        '_method',
        'PUT'
    );

    formData.append(
        'nama',
        document.getElementById('editNama').value
    );

    formData.append(
        'kategori',
        document.getElementById('editKategori').value
    );

    formData.append(
        'target',
        document.getElementById('editTarget').value
    );

    formData.append(
        'tanggal_mulai',
        document.getElementById('editTanggal').value
    );

    const gambar =
        document.getElementById('editGambar');

    if(gambar.files.length > 0){

        formData.append(
            'gambar',
            gambar.files[0]
        );
    }

    const response = await fetch(
        `/admin/program-donasi/${id}/ajax-update`,
        {
            method: 'POST',
            body: formData
        }
    );

    if(response.ok){

        alert('Program berhasil diperbarui.');

        location.reload();

    }else{

        alert('Gagal memperbarui program.');
    }
});


</script>

@endsection

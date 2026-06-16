@extends('layouts.admin')

@section('content')

<div class="page-header">

    <div>

        <h1>Tambah Program Donasi</h1>

        <p>
            Buat program donasi baru untuk membantu lebih banyak penerima manfaat.
        </p>

    </div>

</div>

<div class="form-card">

    <form action="{{ route('admin.program-donasi.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-grid">

            <div class="form-group full">

                <label>Nama Program</label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Masukkan nama program"
                       value="{{ old('nama') }}">

                @error('nama')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">

                <label>Kategori</label>

                <select name="kategori"
                        class="form-control">

                    <option value="">Pilih Kategori</option>

                    <option value="Bencana Alam"
                        {{ old('kategori') == 'Bencana Alam' ? 'selected' : '' }}>
                        Bencana Alam
                    </option>

                    <option value="Anak Yatim"
                        {{ old('kategori') == 'Anak Yatim' ? 'selected' : '' }}>
                        Anak Yatim
                    </option>

                    <option value="Pendidikan"
                        {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>
                        Pendidikan
                    </option>

                    <option value="Masjid"
                        {{ old('kategori') == 'Masjid' ? 'selected' : '' }}>
                        Masjid
                    </option>

                    <option value="Kesehatan"
                        {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>
                        Kesehatan
                    </option>

                </select>

                @error('kategori')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">

                <label>Target Dana</label>

                <input type="number"
                       name="target"
                       class="form-control"
                       placeholder="Contoh: 50000000"
                       value="{{ old('target') }}">

                @error('target')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group full">

                <label>Tanggal Mulai</label>

                <input type="date"
                       name="tanggal_mulai"
                       class="form-control"
                       value="{{ old('tanggal_mulai') }}">

                @error('tanggal_mulai')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group full">

                <label>Foto Program</label>

                <div class="upload-wrapper">

                    <input type="file"
                           name="gambar"
                           id="gambar"
                           accept="image/*"
                           hidden>

                    <label for="gambar"
                           class="upload-box">

                        <i class="fa-solid fa-cloud-arrow-up"></i>

                        <p>
                            Klik untuk mengunggah foto program
                        </p>

                        <small>
                            Format JPG, PNG (maks. 2 MB)
                        </small>

                    </label>

                </div>

                <img id="preview"
                     class="preview-image">

                @error('gambar')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-footer">

            <a href="{{ route('admin.program-donasi.index') }}"
               class="btn-batal">

                Batal

            </a>

            <button type="submit"
                    class="btn-simpan">

                Simpan Program

            </button>

        </div>

    </form>

</div>


<style>

.page-header{

    margin-bottom:30px;

}

.page-header h1{

    font-size:36px;

    margin-bottom:10px;

    color:#0f172a;

}

.page-header p{

    color:#64748b;

}

.form-card{

    background:white;

    border-radius:24px;

    padding:40px;

    box-shadow:0 4px 20px rgba(0,0,0,.05);

}

.form-grid{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:25px;

}

.form-group{

    display:flex;

    flex-direction:column;

}

.form-group.full{

    grid-column:1 / -1;

}

.form-group label{

    margin-bottom:10px;

    font-weight:600;

    color:#1e293b;

}

.form-control{

    width:100%;

    padding:15px 18px;

    border:1px solid #d1d5db;

    border-radius:14px;

    font-size:15px;

    outline:none;

    transition:.2s;

}

.form-control:focus{

    border-color:#22c55e;

    box-shadow:0 0 0 4px rgba(34,197,94,.15);

}

.upload-box{

    border:2px dashed #cbd5e1;

    border-radius:18px;

    padding:40px;

    text-align:center;

    cursor:pointer;

    transition:.2s;

    display:block;

}

.upload-box:hover{

    border-color:#22c55e;

    background:#f0fdf4;

}

.upload-box i{

    font-size:42px;

    color:#22c55e;

    margin-bottom:15px;

}

.upload-box p{

    margin-bottom:10px;

    color:#1e293b;

}

.upload-box small{

    color:#64748b;

}

.preview-image{

    width:100%;

    max-height:250px;

    object-fit:contain;

    border-radius:18px;

    margin-top:20px;

    display:none;

    border:1px solid #e2e8f0;

}

.error{

    color:#dc2626;

    margin-top:8px;

}

.form-footer{

    margin-top:40px;

    display:flex;

    justify-content:flex-end;

    gap:15px;

}

.btn-batal{

    padding:14px 24px;

    border-radius:14px;

    background:#e2e8f0;

    color:#475569;

    text-decoration:none;

    font-weight:600;

}

.btn-simpan{

    padding:14px 24px;

    border:none;

    border-radius:14px;

    background:#22c55e;

    color:white;

    font-weight:600;

    cursor:pointer;

    transition:.2s;

}

.btn-simpan:hover{

    background:#16a34a;

}

@media(max-width:768px){

    .form-grid{

        grid-template-columns:1fr;

    }

}

</style>


<script>

document.getElementById('gambar')
    .addEventListener('change', function(){

        if(this.files.length > 0){

            const preview =
                document.getElementById('preview');

            preview.src =
                URL.createObjectURL(this.files[0]);

            preview.style.display =
                'block';
        }
    });

</script>

@endsection

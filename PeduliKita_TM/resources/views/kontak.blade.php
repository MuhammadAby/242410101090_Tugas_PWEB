@extends('layouts.app')

@section('content')

<section class="page-header">
    <h1>Kontak Kami</h1>
    <p>Hubungi tim PeduliKita</p>
</section>

<section class="content-box">

    <form class="form-kontak">

        <div class="form-grup">
            <label>Nama</label>
            <input type="text">
        </div>

        <div class="form-grup">
            <label>Email</label>
            <input type="email">
        </div>

        <div class="form-grup">
            <label>Pesan</label>
            <textarea rows="5"></textarea>
        </div>

        <button class="btn-simpan">
            Kirim Pesan
        </button>

    </form>

</section>

@endsection

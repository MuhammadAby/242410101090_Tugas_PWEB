@extends('layouts.app')

@section('content')

<section style="padding: 20px;">
    <h1>Kontak Kami</h1>

    <p style="margin-top:10px;">Silakan hubungi kami melalui:</p>

    <ul style="margin-top:10px;">
        <li>📍 Alamat: Jl. Kalimantan No. 10, Jember</li>
        <li>📞 Telepon: (021) 9876-5432</li>
        <li>✉️ Email: pedulikita@gmail.com</li>
    </ul>

</section>

@push('scripts')
<script>
    console.log("Halaman Kontak aktif");
</script>
@endpush

@endsection

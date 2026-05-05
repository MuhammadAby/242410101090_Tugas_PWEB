@extends('layouts.app')

@section('content')

<section style="padding: 20px;">
    <h1>Tentang PeduliKita</h1>

    <p style="margin-top:10px;">
        PeduliKita adalah sistem informasi pengelolaan donasi berbasis web
        yang bertujuan untuk memudahkan pengelolaan program donasi,
        data donatur, serta laporan keuangan secara transparan.
    </p>

    <p style="margin-top:10px;">
        Dengan adanya platform ini, diharapkan masyarakat dapat lebih mudah
        dalam berdonasi dan memantau perkembangan donasi secara real-time.
    </p>

</section>

@push('scripts')
<script>
    console.log("Halaman Tentang aktif");
</script>
@endpush

@endsection

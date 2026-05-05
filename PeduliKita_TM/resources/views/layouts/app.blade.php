<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeduliKita</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <section class="footer-grid">
            <div class="footer-kolom">
                <h3>PeduliKita</h3>
                <p>Sistem Informasi Pengelolaan Donasi Berbasis Web</p>
                <p>📍 Jl. Kalimantan No. 10, Jember</p>
                <p>📞 (021) 9876-5432</p>
                <p>✉️ pedulikita@gmail.com</p>
            </div>
            <div class="footer-kolom">
                <h3>Menu</h3>
                <a href="#">Dashboard</a>
                <a href="#">Program Donasi</a>
                <a href="#">Donatur</a>
                <a href="#">Laporan</a>
            </div>
            <div class="footer-kolom">
                <h3>Informasi</h3>
                <a href="#">Cara Berdonasi</a>
                <a href="#">FAQ</a>
            </div>
        </section>
        <p class="footer-bawah">&copy; 2026 PeduliKita</p>
    </footer>

    {{-- JS --}}
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')

</body>
</html>

<nav class="navbar">
    <figure class="navbar-brand">
        <img src="{{ asset('images/Logo Donasi.png') }}" alt="Logo PeduliKita" height="40" />
        <span class="navbar-judul">PeduliKita</span>
    </figure>
    <div class="navbar-menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
        <a href="#">Program Donasi</a>
        <a href="#">Donatur</a>
        <a href="#">Laporan</a>
    </div>
</nav>

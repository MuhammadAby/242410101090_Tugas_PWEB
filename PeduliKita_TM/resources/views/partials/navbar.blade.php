<nav class="navbar">

    <div class="navbar-brand">

        <img src="{{ asset('images/Logo Donasi.png') }}"
             alt="Logo"
             height="40">

        <span class="navbar-judul">
            PeduliKita
        </span>

    </div>

    <div class="navbar-menu">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('tentang') }}">
            Tentang
        </a>

        <a href="{{ route('kontak') }}">
            Kontak
        </a>

        <a href="{{ route('program-donasi.index') }}">
            Program Donasi
        </a>

        @auth
            <span class="navbar-user">

                Halo, {{ auth()->user()->name }}

            </span>

            <form action="{{ route('logout') }}"
                method="POST">

                @csrf
                <button type="submit"
                        class="btn-auth">
                    Logout
                </button>
            </form>
        @else

            <a href="{{ route('login') }}"
            class="btn-auth">

                Login

            </a>

            <a href="{{ route('register') }}"
            class="btn-auth">

                Register

            </a>

        @endauth

    </div>

</nav>

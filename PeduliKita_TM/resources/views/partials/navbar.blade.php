<nav class="navbar">

    <div class="navbar-brand">

        <img src="{{ asset('images/Logo Donasi.png') }}"
             alt="Logo"
             class="logo-navbar">
        </span>

    </div>

    <div class="navbar-menu">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('program-donasi.index') }}">
            Program
        </a>

        <a href="{{ route('tentang') }}">
            Tentang
        </a>

        <a href="{{ route('kontak') }}">
            Kontak
        </a>

        <button id="toggleDark"
                class="btn-dark">
            🌙
        </button>

        @auth

            <span class="navbar-user">

                👋 {{ auth()->user()->name }}

            </span>

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="btn-auth logout">

                    Logout

                </button>

            </form>

        @else

            <a href="{{ route('login') }}"
               class="btn-auth login">

                Login

            </a>

            <a href="{{ route('register') }}"
               class="btn-auth register">

                Register

            </a>

        @endauth

    </div>

</nav>

<style>

.navbar{
    position: sticky;
    top: 0;
    z-index: 1000;

    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 18px 8%;

    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(12px);

    box-shadow: 0 5px 20px rgba(0,0,0,.06);
}

.navbar-brand{
    display: flex;
    align-items: center;
    gap: 12px;
}

.navbar-brand img{
    height: 30px !important;
    width: auto;
}

.logo-navbar{
    height: 80px;
    width: auto;
}

.navbar-judul{
    font-size: 1.6rem;
    font-weight: 700;
    color: #be163d;
}

.navbar-menu{
    display: flex;
    align-items: center;
    gap: 15px;
}

.navbar-menu a{
    text-decoration: none;
    color: #444;
    font-weight: 500;

    transition: .3s ease;
}

.navbar-menu a:hover{
    color: #be163d;
}

.btn-dark{
    width: 42px;
    height: 42px;

    border: none;
    border-radius: 50%;

    cursor: pointer;

    background: #f5f5f5;

    font-size: 18px;

    transition: .3s ease;
}

.btn-dark:hover{
    transform: rotate(15deg);
}

.navbar-user{
    padding: 10px 16px;

    border-radius: 50px;

    background: #fff1f3;

    color: #be163d;

    font-weight: 600;
}

.btn-auth{
    padding: 10px 18px;

    border-radius: 12px;

    text-decoration: none;

    font-weight: 600;

    border: none;

    cursor: pointer;

    transition: .3s ease;
}

.login{
    background: white;
    color: #be163d;
    border: 2px solid #be163d;
}

.login:hover{
    background: #fff1f3;
}

.register{
    background: #be163d;
    color: white;
}

.register:hover{
    transform: translateY(-2px);
}

.logout{
    background: #ad1515;
    color: white;
}

.logout:hover{
    opacity: .9;
}

@media(max-width:768px){

    .navbar{
        flex-direction: column;
        gap: 20px;
    }

    .navbar-menu{
        justify-content: center;
        flex-wrap: wrap;
    }

    .navbar-judul{
        font-size: 1.4rem;
    }

}

</style>

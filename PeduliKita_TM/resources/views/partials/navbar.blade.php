<nav class="navbar">

    <div class="navbar-brand">

        <a href="{{ route('dashboard') }}">

            <img src="{{ asset('images/Logo Donasi.png') }}"
                 alt="PeduliKita"
                 class="logo-navbar">

        </a>

    </div>

    <div class="navbar-menu">

        <a href="#hero">
            Beranda
        </a>

        <a href="#program">
            Program Donasi
        </a>

        <a href="#tentang">
            Tentang Kami
        </a>

        {{-- <a href="#visi-misi">
            Visi & Misi
        </a> --}}

        <a href="#kontak">
            Hubungi Kami
        </a>

        {{-- <a href="#program"
           class="btn-donasi">

            Donasi Sekarang

        </a> --}}

    </div>

</nav>

<style>

html{
    scroll-behavior:smooth;
}

main{
    margin-top: 80px;
}

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
    display:flex;

    align-items:center;

    gap:28px;
}

.navbar-menu a{
    text-decoration:none;

    color:#444;

    font-weight:600;

    transition:.3s;
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

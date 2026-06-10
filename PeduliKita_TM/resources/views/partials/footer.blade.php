<footer class="footer">

    <div class="footer-container">

        <div class="footer-section">

            <h2 class="footer-logo">

                ❤️ PeduliKita

            </h2>

            <p>

                Platform donasi digital yang membantu
                masyarakat berbagi dengan mudah,
                transparan, dan terpercaya.

            </p>

        </div>

        <div class="footer-section">

            <h3>

                Navigasi

            </h3>

            <a href="{{ route('dashboard') }}">

                Dashboard

            </a>

            <a href="{{ route('program-donasi.index') }}">

                Program Donasi

            </a>

            <a href="{{ route('tentang') }}">

                Tentang

            </a>

            <a href="{{ route('kontak') }}">

                Kontak

            </a>

        </div>

        <div class="footer-section">

            <h3>

                Kontak

            </h3>

            <p>

                📧 pedulikita@gmail.com

            </p>

            <p>

                📍 Jember, Indonesia

            </p>

            <p>

                📞 +62 812-3456-7890

            </p>

        </div>

    </div>

    <div class="footer-bottom">

        © {{ date('Y') }} PeduliKita.
        Dibuat untuk memenuhi tugas Pemrograman Web.

    </div>

</footer>

<style>

.footer{

    margin-top: 80px;

    background: linear-gradient(
        135deg,
        #be163d,
        #8f102d
    );

    color: white;

    padding-top: 60px;

}

.footer-container{

    width: 90%;

    max-width: 1200px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(
            auto-fit,
            minmax(250px, 1fr)
        );

    gap: 40px;

}

.footer-logo{

    margin-bottom: 20px;

    font-size: 1.8rem;

}

.footer-section h3{

    margin-bottom: 20px;

}

.footer-section p{

    line-height: 1.8;

    opacity: .9;

}

.footer-section a{

    display: block;

    color: rgba(255,255,255,.9);

    text-decoration: none;

    margin-bottom: 12px;

    transition: .3s;

}

.footer-section a:hover{

    color: white;

    transform: translateX(5px);

}

.footer-bottom{

    margin-top: 50px;

    padding: 20px;

    text-align: center;

    border-top:
        1px solid
        rgba(255,255,255,.2);

    font-size: .95rem;

    opacity: .9;

}

@media(max-width:768px){

    .footer{

        text-align: center;

    }

}

</style>

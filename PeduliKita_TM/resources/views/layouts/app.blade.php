<!DOCTYPE html>
<html lang="en">

<head>
    <script>
    (function() {
        let theme = document.cookie.match(/theme=([^;]+)/);

        if (theme && theme[1] === 'dark') {
            document.documentElement.classList.add('dark');
        }

        let font = document.cookie.match(/font=([^;]+)/);

        if (font) {
            document.documentElement.style.fontSize =
                font[1] === 'small' ? '12px' :
                font[1] === 'large' ? '20px' : '16px';
        }
    })();
    </script>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>PeduliKita</title>

    @vite([
        'resources/css/app.css',
        'resources/css/pedulikita.css',
        'resources/js/app.js'
    ])

</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <script>

    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');

        for(let i=0;i < ca.length;i++) {
            let c = ca[i].trim();

            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length);
            }
        }

        return null;
    }

    document.addEventListener("DOMContentLoaded", function () {

        const btn = document.getElementById('toggleDark');

        if (getCookie('theme') === 'dark') {
            document.body.classList.add('dark');
        }

        // PERBAIKAN DI SINI
        if (btn) {

            btn.addEventListener('click', function () {

                document.body.classList.toggle('dark');

                if (document.body.classList.contains('dark')) {
                    setCookie('theme', 'dark', 7);
                } else {
                    setCookie('theme', 'light', 7);
                }

            });

        }

    });

</script>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))

        <div class="alert-success">

            {{ session('success') }}

        </div>

    @endif

    {{-- CONTENT --}}
    <main>

        @yield('content')

    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    @stack('scripts')



</body>



</html>

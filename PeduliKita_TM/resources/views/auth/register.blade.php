<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PeduliKita</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f8fafc;
            overflow:hidden;
            position:relative;
            padding:20px;
        }

        body::before{
            content:'';
            position:absolute;
            top:-250px;
            left:-250px;
            width:500px;
            height:500px;
            border-radius:50%;
            background:rgba(190,22,61,0.08);
        }

        body::after{
            content:'';
            position:absolute;
            bottom:-250px;
            right:-250px;
            width:500px;
            height:500px;
            border-radius:50%;
            background:rgba(190,22,61,0.08);
        }

        .container{
            width:800px;
            max-width:95%;
            height:580px;
            background:white;
            border-radius:30px;
            box-shadow:0 20px 40px rgba(0,0,0,.1);
            display:grid;
            grid-template-columns:1fr 1fr;
            overflow:hidden;
            z-index:10;
        }

        .form-section{
            padding:30px 40px;
        }

        .logo{
            color:#be163d;
            font-size:32px;
            font-weight:bold;
            margin-bottom:10px;
        }

        .subtitle{
            color:#777;
            margin-bottom:40px;
        }

        .input-group{
            margin-bottom:15px;
        }

        .input-group label{
            display:block;
            margin-bottom:6px;
            font-weight:600;
        }

        .input-group input{
            width:100%;
            padding:10px 14px;
            border:1px solid #ddd;
            border-radius:15px;
            font-size:15px;
            transition:.3s;
        }

        .input-group input:focus{
            outline:none;
            border-color:#be163d;
            box-shadow:0 0 0 3px rgba(190,22,61,.1);
        }

        .error{
            color:red;
            font-size:13px;
            margin-top:5px;
        }

        .btn-register{
            width:100%;
            padding:12px;
            border:none;
            border-radius:15px;
            background:#be163d;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn-register:hover{
            background:#9f1239;
        }

        .login-link{
            margin-top:25px;
            text-align:center;
        }

        .login-link a{
            color:#be163d;
            text-decoration:none;
            font-weight:600;
        }

        .illustration{
            background:linear-gradient(
                135deg,
                #fef2f2,
                #ffe4e6
            );
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:40px;
            text-align:center;
        }

        .illustration img{
            width:180px;
            margin-bottom:20px;
        }

        .illustration h2{
            color:#be163d;
            margin-bottom:15px;
        }

        .illustration p{
            color:#666;
            line-height:1.6;
        }

        .links{
            margin-top:20px;
            text-align:center;
        }

        .links a{
            color:#be163d;
            text-decoration:none;
            font-weight:600;
        }

        @media(max-width:768px){

            .container{
                grid-template-columns:1fr;
            }

            .illustration{
                display:none;
            }

            .form-section{
                padding:35px 25px;
            }

        }
    </style>
</head>

<body>

<div class="container">

    <div class="form-section">

        <div class="logo">
            PeduliKita
        </div>

        <p class="subtitle">
            Bergabunglah untuk membantu sesama.
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required
                >

                @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                >
            </div>

            <button class="btn-register">
                Daftar Sekarang
            </button>

        </form>

        <div class="links">
            <a href="{{ route('login') }}">
                Sudah punya akun?
            </a>
        </div>

    </div>

    <div class="illustration">

        <img src="https://cdn-icons-png.flaticon.com/512/3209/3209265.png"
             alt="Register">

        <h2>
            PeduliKita
        </h2>

        <p>
            Kelola donasi dan berkontribusi
            untuk membantu mereka yang membutuhkan.
        </p>

    </div>

</div>

</body>
</html>

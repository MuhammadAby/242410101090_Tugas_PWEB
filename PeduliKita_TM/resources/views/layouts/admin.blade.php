<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PeduliKita</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f5f7fb;
            color:#0f172a;
        }

        .admin-wrapper{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:250px;
            background:#fff;
            border-right:1px solid #e2e8f0;

            display:flex;
            flex-direction:column;

            padding:25px 20px;

            position:fixed;
            left:0;
            top:0;
            bottom:0;
        }

        .logo{
            margin-bottom:35px;
        }

        .logo h2{
            color:#15803d;
            font-size:32px;
            font-weight:800;
        }

        .logo p{
            color:#64748b;
            font-size:14px;
        }

        .btn-program{
            display:block;

            text-decoration:none;

            background:#22c55e;
            color:white;

            text-align:center;

            padding:14px;

            border-radius:14px;

            font-weight:600;

            margin-bottom:30px;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .menu a{
            text-decoration:none;

            color:#334155;

            padding:14px 18px;

            border-radius:14px;

            display:flex;
            align-items:center;
            gap:14px;

            font-weight:500;

            transition:.2s;
        }

        .menu a:hover{
            background:#f1f5f9;
        }

        .menu a.active{
            background:#22c55e;
            color:white;
        }

        .sidebar-footer{
            margin-top:auto;
        }

        /* CONTENT */

        .main-content{
            margin-left:250px;
            flex:1;
        }

        /* TOPBAR */

        .topbar{
            height:80px;

            background:white;

            border-bottom:1px solid #e2e8f0;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:0 35px;
        }

        .topbar h1{
            font-size:20px;
        }

        .topbar-right{
            display:flex;
            align-items:center;
            gap:20px;
        }

        .topbar-icon{
            font-size:20px;
            color:#475569;
        }

        .profile-circle{
            width:42px;
            height:42px;

            border-radius:50%;

            background:#22c55e;
            color:white;

            display:flex;
            align-items:center;
            justify-content:center;

            font-weight:bold;
        }

        /* CONTENT BODY */

        .content{
            padding:30px;
        }

        @media(max-width:992px){

            .sidebar{
                width:80px;
            }

            .sidebar .logo p,
            .sidebar .logo h2,
            .btn-program span,
            .menu span{
                display:none;
            }

            .main-content{
                margin-left:80px;
            }

        }

    </style>

</head>

<body>

<div class="admin-wrapper">

    @include('admin.partials.sidebar')

    <div class="main-content">

        <div class="topbar">

            <h1>Admin Console</h1>

            <div class="topbar-right">

                <i class="fa-regular fa-bell topbar-icon"></i>

                <i class="fa-regular fa-circle-question topbar-icon"></i>

                <div class="profile-circle">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

            </div>

        </div>

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

</body>

</html>

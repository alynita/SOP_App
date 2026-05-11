<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi SOP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #0b6b3a; /* hijau Kemenkes */
            color: white;
            position: fixed;
        }

        /* LOGO AREA */
        .sidebar .logo {
            padding: 20px 10px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar .logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .sidebar .logo b {
            display: block;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* MENU LINK */
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            display: block;
            margin: 2px 8px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(3px);
        }

        /* SECTION TITLE */
        .sidebar .section {
            font-size: 11px;
            color: rgba(255,255,255,0.7);
            padding: 10px 14px 4px;
            margin-top: 10px;
        }

        /* LOGOUT BUTTON */
        .sidebar button {
            border: none;
            background: none;
            color: white;
            padding: 10px 14px;
            width: 100%;
            text-align: left;
            margin: 2px 8px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar button:hover {
            background: rgba(255,255,255,0.15);
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 240px;
        }

    </style>
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <!-- LOGO -->
        <div class="logo">
            <img src="/logo-kemenkes.png" alt="Logo">
            <b>BBPK SOP</b>
        </div>

        <!-- DASHBOARD -->
        @if(auth()->user()->role == 'timker4')
            <a href="/dashboard-timker4">🏠 Dashboard PM</a>
        @else
            <a href="/dashboard">🏠 Dashboard</a>
        @endif

        <!-- SOP -->
        <div class="section">MANAJEMEN SOP</div>

        <a href="/sop/create">📥 Input SOP</a>
        <a href="/proses-sop">🔄 Proses SOP</a>
        <a href="/sop">📄 Data SOP</a>

        <!-- PENGATURAN -->
        <div class="section">PENGATURAN</div>

        <a href="{{ route('profile.edit') ?? url('/profile') }}">
            👤 Profil
        </a>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">🚪 Logout</button>
        </form>

    </div>

    <!-- MAIN CONTENT -->
    <div class="main w-100">

        <!-- NAVBAR -->
        <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
            <div>
                <b>Aplikasi SOP</b>
            </div>

            <div>
                User | Logout
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-3">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
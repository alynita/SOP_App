<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi SOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
        }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background: #495057;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="p-3 text-center border-bottom">
            <b>BBPK SOP</b>
        </div>

        <!-- DASHBOARD -->
        <a href="/dashboard">🏠 Dashboard</a>

        <!-- SOP -->
        <div class="px-2 mt-2" style="font-size:12px; color:#adb5bd;">
            MANAJEMEN SOP
        </div>

        <a href="/">📥 Input SOP</a>
        <a href="/sop">📄 Data SOP</a>

        <!-- FLOW / PROSES -->
        <a href="/sop">🔄 Proses SOP</a>

        <!-- PENGATURAN -->
        <div class="px-2 mt-2" style="font-size:12px; color:#adb5bd;">
            PENGATURAN
        </div>

        <a href="#">👤 Profil</a>
        <a href="#">🚪 Logout</a>

    </div>

    <!-- MAIN -->
    <div style="flex:1;">

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
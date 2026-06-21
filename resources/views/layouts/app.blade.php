<!DOCTYPE html>
<html>
<head>
    <title>E-SOP</title>

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
            width: 140px;
            height: auto;
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
            <img src="/logo.png" alt="Logo">
            <b>E-SOP</b>
        </div>

        <!-- DASHBOARD -->
        @if(auth()->user()->role == 'kepala')

            <a href="/dashboard-kepala">
                🏠 Dashboard Kepala BBPK Jakarta
            </a>

            <div class="section">PENGESAHAN SOP</div>

            <a href="/kepala/persetujuan">
                ✍️ Pengesahan SOP
            </a>

            <a href="/kepala/arsip">
                🗂 Arsip SOP
            </a>

        @elseif(auth()->user()->role == 'admin')

            <a href="/admin/dashboard">🏠 Dashboard Administrator Sistem</a>

            <div class="section">ADMIN</div>

            <a href="/admin/users">👥 Data User</a>

            <a href="/admin/pelaksana">🧑‍💼 Data Pelaksana</a>

            <a href="/admin/monitoring">📊 Monitoring SOP</a>

        @else

            @if(auth()->user()->role == 'timker4')
                <a href="/dashboard-timker4">🏠 Dashboard Penjaminan Mutu</a>
            @else
                <a href="/dashboard">🏠 Dashboard</a>
            @endif

            <!-- SOP -->
            <div class="section">MANAJEMEN SOP</div>

            <a href="/sop/create">📥 Input SOP</a>

            <a href="/proses-sop">🔄 Proses SOP</a>

            <a href="/sop">📄 Data SOP</a>

            @if(auth()->user()->role == 'timker4')

                <a href="/timker4/revisi">
                    📝 SOP Revisi
                </a>

                <a href="/timker4/arsip">
                    🗂 Arsip SOP
                </a>

            @endif

        @endif

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

            <div class="d-flex align-items-center gap-3">

            <!-- NOTIF -->
            <div class="dropdown">

                <button
                    class="btn btn-light position-relative"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    🔔

                    @if(isset($notifications) && $notifications->where('is_read', false)->count() > 0)

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            {{ $notifications->where('is_read', false)->count() }}

                        </span>

                    @endif

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow"
                    style="
                        width: 320px;
                        max-height: 400px;
                        overflow-y: auto;
                    ">

                    @forelse($notifications as $notif)

                        <li>

                            <a
                                class="dropdown-item text-wrap py-2"
                                href="/notifications/read/{{ $notif->id }}">

                                {{ $notif->pesan }}

                            </a>

                        </li>

                    @empty

                        <li>

                            <span class="dropdown-item text-muted">
                                Tidak ada notifikasi
                            </span>

                        </li>

                    @endforelse

                </ul>

            </div>

            <!-- USER -->
            <div>
                {{ auth()->user()->name }}
            </div>

        </div>
        </div>

        <!-- CONTENT -->
        <div class="p-3">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: var(--bs-primary);
            min-height: 100vh;
        }


        .sidebar .nav-link {
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link.active {
            background-color: #fff !important;
            color: var(--bs-primary) !important;
            font-weight: 600;
        }

        .sidebar .nav-link i {
            margin-right: 8px;
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
            }

            .sidebar .nav {
                flex-direction: row;
                justify-content: space-around;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="d-flex">

    <nav class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
        <a href="{{ url('/employees') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
            <span class="fs-5 fw-semibold">App Pegawai</span>
        </a>
        <hr class="text-white">

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-people-fill"></i> Pegawai
                </a>
            </li>
            <li>
                <a href="{{ route('departments.index') }}" class="nav-link {{ request()->is('departments*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-building"></i> Departemen
                </a>
            </li>
            <li>
                <a href="{{ route('positions.index') }}" class="nav-link {{ request()->is('positions*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-briefcase"></i> Jabatan
                </a>
            </li>
            <li>
                <a href="{{ route('salaries.index') }}" class="nav-link {{ request()->is('salaries*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-cash-stack"></i> Gaji
                </a>
            </li>
        </ul>

        <hr class="text-white">
        <div class="text-center small">
            <span>&copy; {{ date('Y') }} App Pegawai</span>
        </div>
    </nav>

    <div class="container-fluid p-4 voerflow-auto">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="fw-bold text-dark mb-1">@yield('page-title', 'Dashboard')</h2>
                <p class="text-muted mb-0">@yield('subtitle', 'Kelola data pegawai dan sistem kehadiran')</p>
            </div>
            <div class="mt-2 mt-md-0">
                @yield('page-action')
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

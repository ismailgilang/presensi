<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @yield('css')
    <style>
        body {
            background-color: #e8e8e8;
            color: #000000;
        }

        .navbar {
            background-color: #007bff !important;
            width: 100%;
        }

        .navbar-brand {
            padding-left: 20px;
            color: #ffffff !important;
        }

        .navbar-nav {
            width: 98%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .container {
            width: 100%;
            height: max-content;
            margin: 0;
            display: flex;
            margin: auto;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ url('/dashboardU') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboardU/profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboardU/dataabsen') }}">Data absen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboardU/absen') }}">Presensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboardU/pengajuan') }}">Pengajuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-3">
        @yield('content')
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/datatables-simple-demo.js') }} "></script>
    @yield('js')
</body>

</html>

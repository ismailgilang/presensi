<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #000;
        }

        .navbar {
            background-color: #007bff !important;
            width: 100%;
        }

        .navbar-brand {
            padding-left: 20px;
            color: #fff !important;
        }

        .navbar-nav {
            width: 98%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .nav-link {
            color: #fff !important;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .text-center {
            text-align: center;
        }

        .img-fluid {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .list-group {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .list-group-item {
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 10px;
            background-color: #e9f7fe;
            color: #007bff;
        }

        .list-group-item:hover {
            background-color: #d0e9fb;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        td {
            color: #000;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ url('/dashboardU') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="{{ url('/dashboardU/patroli') }}">Patroli</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboardU/absen') }}">Absen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Reset Password</h1>
                        <div class="row">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <form action="{{ route('updatePW') }}" method="POST">
                                        @csrf
                                        <!-- Input Tersembunyi untuk ID Pengguna -->
                                        <input type="hidden" name="id" value="{{ $user->id }}">

                                        <!-- Informasi Pengguna -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="Cpassword">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="Cpassword" name="Cpassword" required>
                                        </div>
                                        <!-- Tombol Submit -->
                                        <div class="d-flex justify-content-between"><a href="{{route('profile')}}" class="btn btn-danger">Kembali</a><button type="submit" class="btn btn-primary">Update Profile</button></div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
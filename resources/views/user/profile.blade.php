<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }

        .navbar {
            background-color: #007bff !important;
            width: 100%;
        }

        .navbar-brand {
            color: #fff !important;
            padding-left: 20px;
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
            border: 1px solid #ddd;
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
            border: none;
            border-radius: 10px;
            background-color: #f1f1f1;
            color: #212529;
        }

        .list-group-item:hover {
            background-color: #e2e6ea;
        }

        td {
            color: #212529;
        }

        .profile-wrapper {
            position: relative;
            display: inline-block;
            text-align: center;
        }

        .profile-picture {
            width: 180px;
            /* Ukuran gambar untuk tampilan desktop */
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .edit-button {
            position: absolute;
            bottom: 30px;
            right: 35px;
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            padding: 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .edit-button i {
            pointer-events: none;
        }

        .edit-button:hover {
            transform: scale(1.1);
        }

        @media (max-width: 991px) {
            .profile-picture {
                width: 120px;
                /* Ukuran gambar lebih kecil untuk tampilan mobile */
                height: 120px;
            }

            .edit-button {
                bottom: 10px;
                /* Menggeser tombol ke bawah */
                right: -30px;
                /* Mengurangi jarak dari kanan */
                padding: 8px;
                /* Mengurangi ukuran tombol */
                font-size: 14px;
                /* Mengurangi ukuran font */
            }
            
            .disname{
                text-align: center; 
            }

            .display2{
                display: flex;
                flex-direction: column;
            }
        }

        /* Media queries untuk tampilan mobile */
        @media (max-width: 767px) {
            .profile-picture {
                width: 120px;
                /* Ukuran gambar lebih kecil untuk tampilan mobile */
                height: 120px;
            }

            .edit-button {
                bottom: 20px;
                /* Menggeser tombol ke bawah */
                right: 150px;
                /* Mengurangi jarak dari kanan */
                padding: 8px;
                /* Mengurangi ukuran tombol */
                font-size: 14px;
                /* Mengurangi ukuran font */
            }

            .display2{
                display: flex;
                flex-direction: row;
            }
        }

        

        @media (max-width: 480px) {
            .profile-picture {
                width: 100px;
                /* Ukuran gambar lebih kecil untuk layar yang lebih kecil */
                height: 100px;
            }

            .edit-button {
                bottom: 10px;
                /* Menggeser tombol lebih ke bawah */
                right: 80px;
                /* Mengurangi jarak dari kanan */
                padding: 6px;
                /* Mengurangi ukuran tombol lebih lanjut */
                font-size: 12px;
                /* Mengurangi ukuran font lebih lanjut */
            }
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
                        <h1 class="text-center">Halaman Profile</h1>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <hr>
                        <div class="row display2">
                            @if (isset($user->profile))
                            <div class="col-md-4 profile-wrapper">
                                <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Picture" class="profile-picture">
                                <button class="edit-button" onclick="openProfile()">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            @else
                            <div class="col-md-4 profile-wrapper">
                                <i class="fa fa-user-circle fa-10x"></i>
                                <button class="edit-button" onclick="openProfile()">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            @endif
                            <div class="col mt-3 disname">
                                <h2>{{ $user->name }}</h2>
                                <p class="mt-3">{{ $user->nik }}</p>
                                <p>{{ $user->email }}</p>
                                @if (isset($user->nohp))
                                <p>{{ $user->nohp }}</p>
                                @else
                                <p>Nomor hp belum ada</p> @endif
                            </div>
                        </div>
                        <div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Jabatan</td>
                    <td>{{ $user->jabatan }}</td>
                </tr>
                <tr>
                    <td>Tanggal Bergabung</td>
                    <td>{{ $data->tanggal }}</td>
                </tr>
            </table>
            <div class="d-flex justify-content-between">
                <a href="{{ route('resetUserPW', ['id' => $user->id]) }}" class="btn btn-warning"><i
                        class="fa fa-rotate"></i> Rubah Password</a>
                <a href="{{ route('edit.profile', ['id' => $user->id]) }}" class="btn btn-primary"><i
                        class="fa fa-pencil"></i></a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <!-- Modal foto -->
    <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-profile-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('uploadP') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-profile-label">Profile Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control-file" id="id" name="id"
                                value="{{ $user->id }}">
                            <label for="profile">Pilih Profile Picture:</label>
                            <input type="file" class="form-control-file" id="profile" name="profile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Load Bootstrap JS (make sure Bootstrap JS is loaded after jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openProfile() {
            $('#modal-profile').modal('show'); // menggunakan jQuery untuk menampilkan modal
        }
    </script>
    </body>

</html>

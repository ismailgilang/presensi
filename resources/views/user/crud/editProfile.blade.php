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
            border: none;
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
            background-color: #007bff;
            color: #fff;
        }

        .list-group-item:hover {
            background-color: #0056b3;
        }

        td {
            color: black;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .modal-content {
            background-color: #fff;
            color: #000;
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
                        <h1 class="text-center">Halaman Edit Profile</h1>
                        <div class="row">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <form action="{{ route('update.profile') }}" method="POST">
                                        @csrf
                                        <!-- Input Tersembunyi untuk ID Pengguna -->
                                        <input type="hidden" name="id" value="{{ $user->id }}">

                                        <!-- Informasi Pengguna -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nohp">Nomor HP</label>
                                            <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $user->nohp }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $user->jabatan }}" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Bergabung</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" required readonly>
                                        </div>

                                        <!-- Tombol Submit -->
                                        <div class="d-flex justify-content-between"><a href="{{ route('profile') }}" class="btn btn-danger">Kembali</a><button type="submit" class="btn btn-primary">Update Profile</button></div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal foto -->
    <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-profile-label" aria-hidden="true">
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
                            <input type="hidden" class="form-control-file" id="id" name="id" value="{{ $user->id }}">
                            <label for="profile" style="color: black">Pilih Profile Picture:</label>
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
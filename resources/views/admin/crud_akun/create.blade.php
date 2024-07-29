<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f3f4;
        }

        .card {
            background-color: #5e72e4;
            /* Warna latar belakang card */
        }

        label {
            color: white;
        }

        .form-control {
            background-color: white;
            /* Warna latar belakang input */
            color: #fff;
            /* Warna teks input */
        }

        .form-control:focus {
            border-color: #007bff;
            /* Warna border input saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            /* Efek shadow saat fokus */
        }

        .btn-primary {
            background-color: #007bff;
            /* Warna latar belakang tombol primer */
            border-color: #007bff;
            /* Warna border tombol primer */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Warna latar belakang tombol primer saat hover */
            border-color: #0056b3;
            /* Warna border tombol primer saat hover */
        }

        .btn-warning {
            background-color: #ffc107;
            /* Warna latar belakang tombol peringatan */
            border-color: #ffc107;
            /* Warna border tombol peringatan */
        }

        .btn-warning:hover {
            background-color: #e0a800;
            /* Warna latar belakang tombol peringatan saat hover */
            border-color: #e0a800;
            /* Warna border tombol peringatan saat hover */
        }

        .button-group {
            display: flex;
            width: 100%;
        }

        .back {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h2 class="text-center " style="color: white;">Tambah Data</h2>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img class="img-fluid mx-auto mb-5 mt-2" src=" {{asset('foto/logo.png')}}" alt="" style="width: 120px;">
                            </div>
                        </div>
                        <form action="{{ route('akun_admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                            
                            <div class=" form-group">
                                <label for="level">Level</label>
                                <select class="form-control" id="level" name="level">
                                    <option>Default select</option>
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>
                            <div class=" form-group" id="additionalOptions">
                                <label for="jabatan">Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan">
                                    <option>Default select</option>
                                    <optgroup label="Admin">
                                        <option value="administrasi">administrasi</option>
                                        <option value="oprational">oprational</option>
                                        <option value="super">super</option>
                                    </optgroup>
                                    <optgroup label="Users">
                                        <option value="dandru">Dandru</option>
                                        <option value="scrty">Security</option>
                                        <option value="ob">OB</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="button-group">
                                <a href="/akun_admin" class="btn btn-md btn-danger"> <i class="fa fa-arrow"></i> Kembali</a>
                                <div class="back">
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
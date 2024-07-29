<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #eeeeee;
        }

        .container {
            height: 100vh;
        }

        .col {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 500px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="/akun_admin" class="btn btn-success mt-3">Kembali</a>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Data</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update', $userData->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $userData->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ $userData->username }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>

                                <div class="col-md-6">
                                    <select id="level" class="form-control" name="level" required>
                                        <option value="admin" {{ $userData->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $userData->level == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-md-4 col-form-label text-md-right">Jabatan</label>

                                <div class="col-md-6">
                                    <select id="level" class="form-control" name="jabatan" required>
                                        <option value="{{$userData->jabatan}}">{{$userData->jabatan}}</option>
                                        <optgroup label="Admin">
                                            <option value="super" {{ $userData->level == 'admin' ? 'selected' : '' }}>super</option>
                                            <option value="oprational" {{ $userData->level == 'user' ? 'selected' : '' }}>oprational</option>
                                            <option value="administrasi" {{ $userData->level == 'user' ? 'selected' : '' }}>administrasi</option>
                                        </optgroup>
                                        <optgroup label="User">
                                            <option value="dandru" {{ $userData->jabatan == 'dandru' ? 'selected' : '' }}>Danru</option>
                                            <option value="security" {{ $userData->jabatan == 'security' ? 'selected' : '' }}>Security</option>
                                            <option value="ob" {{ $userData->jabatan == 'ob' ? 'selected' : '' }}>ob</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Data
                                    </button>
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
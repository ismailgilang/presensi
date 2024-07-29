<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 mb-5">
        <a href="{{ url('/data_karyawan') }}" class="btn btn-success mt-4">Kembali</a>
        <h2 class="mt-3">Edit Data</h2>
        <form action="{{ route('update-karyawan', $karyawan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nik">NIK :</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ $karyawan->nik }}">
            </div>
            <div class="form-group">
                <label for="name">NAME :</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $karyawan->name }}">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan :</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $karyawan->jabatan }}">
            </div>
            <div class="form-group">
                <label for="area">AREA :</label>
                <input type="text" class="form-control" id="area" name="area" value="{{ $karyawan->area }}">
            </div>
            <div class="form-group">
                <label for="status">STATUS :</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $karyawan->status }}">
            </div>
            <div class="form-group">
                <label for="bpjskt">BPJS Ketenagakerjaan :</label>
                <input type="text" class="form-control" id="bpjskt" name="bpjskt" value="{{ $karyawan->bpjskt }}">
            </div>
            <div class="form-group">
                <label for="bpjskn">BPJS Kesehatan :</label>
                <input type="text" class="form-control" id="bpjskn" name="bpjskn" value="{{ $karyawan->bpjskn }}">
            </div>
            <div class="form-group">
                <label for="tanggal">Bergabung :</label>
                <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ $karyawan->tanggal }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    </div>
</body>

</html>
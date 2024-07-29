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
        <h2 class="mt-3">Tambah Data</h2>
        <form action="{{ route('upload-karyawan') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="font-weight-bold">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" readonly style="color: #121212;">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="name">NAME</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class=" form-group">
                <label class="font-weight-bold" for="level">LEVEL</label>
                <select class="form-control" id="level" name="level">
                    <option>Default select</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class=" form-group" id="additionalOptions">
                <label class="font-weight-bold" for="jabatan">JABATAN</label>
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
            <div class="form-group">
                <label class="font-weight-bold">USERNAME</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">EMAIL</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">PASSWORD</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="area">AREA</label>
                <select name="area" id="area" class="form-control">
                    <option value="-">Pilih Area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area }}">{{ $area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="status">STATUS</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="bpjskt">BPJS Ketenagakerjaan</label>
                <input type="text" class="form-control" id="bpjskt" name="bpjskt" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="bpjskn">BPJS Kesehatan</label>
                <input type="text" class="form-control" id="bpjskn" name="bpjskn" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="tanggal">TANGGAL BERGABUNG</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group" style="display: flex;justify-content:space-between">
                <a href="{{ url('/data_karyawan') }}" class="btn btn-success ">Kembali</a>
                <button type="submit" class="btn btn-primary" style="width: 100px;">Kirim</button>
            </div>
        </form>
    </div>

    </div>
    <script>
        // Mengambil data terakhir dari Laravel menggunakan fetch API
        fetch('{{route("last-id")}}')
            .then(response => response.json())
            .then(data => {
                var lastId = data.lastId || 'RGB-86.10.00.0000';

                // Mendapatkan nomor terakhir dari ID sebelumnya
                var lastNumber = parseInt(lastId.split('.')[3]);

                // Menambahkan 1 untuk mendapatkan nomor berikutnya
                var nextNumber = lastNumber + 1;

                // Format nomor dengan leading zeros jika diperlukan
                var formattedNumber = ('0000' + nextNumber).slice(-4);

                const currentDate = new Date();

                // Mendapatkan nomor bulan (dalam format 01)
                const month = String(currentDate.getMonth() + 1).padStart(2, '0');

                // Menghasilkan ID lengkap
                var randomId = 'RGB-86.10.' + month + '.' + formattedNumber;

                // Memasukkan ID ke dalam input dengan ID "nik"
                document.getElementById('nik').value = randomId;
            })
            .catch(error => console.error('Error:', error));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
</body>

</html>
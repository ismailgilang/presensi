<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background-color: #f7f7f7;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Transparan hitam */
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 40%;
            max-height: 50%;
            margin-top: 40px;
        }

        .close {
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Detail Presensi</h6>
                            <div class="d-flex justify-content-between" style="width: 170px; margin-bottom:15px">
                                <a href="{{route('kehadiran')}}" class="btn btn-danger">Kembali</a>
                                <a href="{{route('cetak')}}" class="btn btn-primary">Cetak</a>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="table-responsive mt-3 mb-3">
                            <table class="table align-items-center " id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">No</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Name</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Image</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Real location</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Tugas</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">NIK</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Sesi</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Keterangan</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Update</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">Option</h6>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $counter = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0">{{ $counter }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{$item->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"><img src="{{ $item->image }}" alt="" style="max-width: 100px;" onclick="openModal('{{ $item->image }}')"></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"><iframe src="{{ $item->rlocation }}&output=embed" width="100%" height="100px" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{$item->tugas }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{$item->nik }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{$item->sesi }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{$item->ket }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0"> {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, MMMM Do YYYY') }}</h6>
                                            </div>
                                        </td>
                                        <td style="gap: 10px;">
                                            <div class="d-flex" style="gap:10px">
                                                <a href="{{ route('edit-karyawan', ['id' => $item->id]) }}" class="btn btn-warning">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{ route('hapus-karyawan', ['id' => $item->id]) }}" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                    @php
                                    $counter++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="myModal" class="modal" onclick="closeModal()">
                                <span class="close">&times;</span>
                                <img class="modal-content" id="modalImg">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk membuka modal dan menetapkan sumber gambar modal
        function openModal(imageSrc) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = imageSrc;
            // Menetapkan posisi modal di tengah layar
            modal.style.alignItems = "center";
            modal.style.justifyContent = "center";
        }

        // Fungsi untuk menutup modal saat tombol tutup diklik
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Tutup modal saat pengguna mengklik di luar area gambar modal
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                searching: true, // Aktifkan fitur pencarian
                lengthChange: true, // Aktifkan fitur perubahan jumlah tampilan
                pageLength: 10 // Tentukan jumlah default baris yang ditampilkan per halaman
            });
        });
    </script>
</body>

</html>